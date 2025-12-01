---
title: Develop a simple multi-model search engine with Laravel.
description: >-
  Sometimes (often, in fact), simplicity in the best way to leverage features.
date: 2022-08-01
thumbnail: /assets/img/posts/develop-a-simple-multi-model-search-engine-with-laravel/thumbnail.jpg
author: philippe
---

![](/assets/img/posts/develop-a-simple-multi-model-search-engine-with-laravel/cover.jpg)

<small>Photo by <a href="https://unsplash.com/@qwitka?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Maksym Kaharlytskyi</a> on <a href="https://unsplash.com/s/photos/index?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></small>

We needed, for an upcoming client project at [Code 16](https://code16.fr/en), to create a simple search engine that searches everywhere and return mixed results. [Laravel Scout](https://laravel.com/docs/9.x/scout) is great, but it comes with restrictions, one being that it's hard to search for multiple model types at once. There are packages out there that can greatly help with that, but the point in this solution is to keep things simple, for three reasons: 

 - First, the obvious: simple code is really important, especially for long term projects (and we have a few of them at Code 16), because of maintenance and teamwork.
 - Code without external packages, if it stays simple, is sometimes preferable: no dependency, and more control.
 - Scout is great with Meilisearch or Algolia for instance, tools that add infrastructure complexity and cost for (much) better performance; but sometimes (more often than expected, I think), performance is not an issue, and direct MySQL queries are fine. 

## Quick description of the data involved in this example

So let’s dive in: imagine that you need to search for posts, pages and projects. Here is a simplified description of each model attributes useful in a search:

 - Post: `title`, `heading`, `body`
 - Page: `title`, `body`
 - Project: `name`, `summary`, `description`

The idea is, in one query, to fetch results for each model and to standardize them in some kind of `SearchResult` object, which is defined with these attributes: `title`, `type`, `url`. At the end, we’ll write a search call like this:

```php
$search = new Search('search this')
$search->getResults();
```

## Search engine implementation

Here’s how we can implement this `Search` class:

```php
class Search
{
    protected Collection $terms;

    public function __construct(string $search)
    {
        $this->terms = collect(explode(' ', $search))
            ->map(fn (string $word) => Str::of($word)
                ->replace('*', '%')
                ->trim()
                ->prepend('%')
                ->append('%')
            );
    }

    public function getResults(): Collection
    {
        return $this->queryPages()
            ->union($this->queryPosts())
            ->union($this->queryProjects())
            ->get()
            ->map(function ($result) {
                $result->url = match($result->type) {
                    'post' => route('post.show', [$result->id, Str::slug($result->title)]),
                    'page' => route('page.show', $result->id),
                    'project' => route('project.show', $result->id)
                };

                return $result;
            });
    }

    private function queryPages(): Builder
    {
        return $this->appendSearchTermsTo(
            DB::table('pages')
                ->select(
                    'id',
                    'title',
                    DB::raw('"" as heading'),
                    'body',
                    DB::raw('"page" as type')
                ),
            ['title', 'body']
        );
    }

    private function queryPosts(): Builder
    {
        return $this->appendSearchTermsTo(
            DB::table('posts')
                ->whereNull('deleted_at')
                ->where('publication_state', 'published')
                ->select(
                    'id',
                    'title',
                    'heading',
                    'body',
                    DB::raw('"post" as type')
                ),
            ['title', 'heading', 'body']
        );
    }
    
    private function queryPosts(): Builder
    {
        return $this->appendSearchTermsTo(
            DB::table('posts')
                ->where('publication_state', 'published')
                ->whereDate('published_at', '<=', today())
                ->orderBy('published_at', 'desc')
                ->select(
                    'id',
                    'title',
                    'heading',
                    'body',
                    DB::raw('"post" as type')
                ),
            ['title', 'heading', 'body']
        );
    }

    private function queryProjects(): Builder
    {
        return $this->appendSearchTermsTo(
            DB::table('projects')
                ->where('publication_state', 'published')
                ->select(
                    'id',
                    DB::raw('name as title'),
                    DB::raw('summary as heading'),
                    DB::raw('description as body'),
                    DB::raw('"project" as type')
                ),
            ['name', 'summary', 'description']
        );
    }

    private function appendSearchTermsTo(Builder $builder, array $attributes): Builder
    {
        $this->terms->each(function (string $term) use ($builder, $attributes) {
            $builder->where(function ($builder) use ($term, $attributes) {
                collect($attributes)
                    ->each(fn ($attribute) => $builder->orWhere($attribute, 'like', $term));
            });
        });

        return $builder;
    }
}
```

This code could be enhanced, but the general idea is here. Let’s review some important parts:

The constructor simply explode the search string in words, framing them with `%`. So `'my search sentence'` will become `['%my%', '%search%', '%sentence%']`.

The main and exposed `getResults()` method builds the query; do note that we don’t use Eloquent here, for performance, but the regular QueryBuilder. Each query is merged to the previous one with a `union`, and finally we get the results (in a real world example we would paginate them), and apply a slight transformation to add an `url` attribute on each result item, based on a `type`.

Each query part is built in a dedicated function; Below is the one responsible for projects:

```php
private function queryProjects(): Builder
{
    return $this->appendSearchTermsTo(
        DB::table('projects')
            ->where('publication_state', 'published')
            ->select(
                'id',
                DB::raw('name as title'),
                DB::raw('summary as heading'),
                DB::raw('description as body'),
                DB::raw('"project" as type')
            ),
        ['name', 'summary', 'description']
    );
}
```

Since we use SQL `union` to merge the queries in one, we need to have the same attributes in the same order in each subquery: hence the `DB::raw` calls which can either rename attributes, or fill them in (in the `type` case).

> *Quick note: one drawback for using the QueryBuilder is that we can’t use query scopes: that’s why we have to be explicit on publication states, published dates (see posts example) or even soft delete (see pages example).*

And finally, the `appendSearchTermsTo()` method is responsible for the criteria part, ensuring that we look at the correct attributes and that it’s an "AND" search; I find it very disturbing that many search packages are  in an "OR" search — meaning it will return results with any word in the query — or a strict search, basically like adding quotes around a search in Google. When I type `sheep cow` I want all the content containing `sheep` and `cow`, anywhere.

## How to use this

We can call the engine like this:

```php
$results = (new Search('search this'))->getResults();
```

The `$results` collection will contain DTO objects (not models) with filled attributes `id`, `type`, `title`, `summary` and `url`; from there, the idea is to display those results a links, without needing to hydrate models. These DTO could be wrapped in a more handy `SearchResult` object, with dedicated and clear methods, but I'll leave it to you.

## What’s missing, and drawbacks

One major point: this is not the right way to implement a search engine with millions of posts. You'll need a better weapon for that... And even for smaller projects, you will need database configuration (meaning indexes) to make it work properly — this is largely documented / blogged elsewhere, you'll find help on this if needed.

Then comes search relevance (how to promote `title` over `body` for instance), result sorting and pagination. Well, this post is already long, but if you want to know how I usually tackle this please tell me, and I'll write a second part to this post.

That’s it, feel free to [catch me on twitter](https://twitter.com/dvlpp) for any comment or question on this.
