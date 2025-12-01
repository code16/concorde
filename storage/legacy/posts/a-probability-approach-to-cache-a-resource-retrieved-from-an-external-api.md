---
title: A probability approach to cache a resource retrieved  from an external API.
description: >-
  Recently I had, for a project at Code 16, to deal with an external API (a very
  bad one, but that’s another story). This is for a book…
date: 2021-02-12
thumbnail: /assets/img/posts/a-probability-approach-to-cache-a-resource-retrieved-from-an-external-api/thumbnail.jpg
author: philippe
---

![](/assets/img/posts/a-probability-approach-to-cache-a-resource-retrieved-from-an-external-api/thumbnail.jpg)

Recently I had, for a project at [Code 16](https://code16.fr/en), to deal with an external API (a very bad one, but [that’s another story](https://medium.com/code16/implement-a-dependance-to-an-external-service-api-with-laravel-5ae7879f124f)). This is for a book store website, and books are retrieved from an online DB through a json API. This API is quite slow, and the website is partially made of recommandation pages (let’s call them “posts”), filled with books which came from this API.

A solution to get around this slowness is to add a cache on each call. This could be implemented at the json call layer or closer to the code, but that’s not the issue: I decided to give up this first idea because books are everywhere in this project, and we need for various reasons to keep a representation of each mentioned book in our own database.

I should add that we just can’t keep the cached book version forever: the price can change, but more importantly the stock level (which comes with the book) of course varies over time.

So we need to store a cached version, but find a way to clear this cache — every developer knows that clearing cache seems an easy thing to do but is very much not.

Next idea was to add some asynchronous system to clear the cache in the DB each week or so, with a scheduled task, but I know that simple solutions are always better, mostly for maintenance purpose.

So the last idea was to add a `refreshed_at` timestamp to each book, and to create some arbitrary rule, like “if the book was retrieved more than 3 days ago, then we need to refresh it”. This would work, but there is (at least) one problem: there is a good chance that all books of a post were retrieve together, and so the unlucky visitor who displays this post on the bad day would wait for all of them to be refreshed. And that’s not fair.

Here’s the solution I found: rather that defining an absolute rule, let’s write a more random one, based on some probabilities. For this I decided to parametrize a “should be refreshed percentage” for each book, based on how old the previous refresh is. For instance:

*   refreshed less that 1 day ago: 0% chance to be refreshed
*   1 to 3 days ago: 20%
*   3 to 10 days ago: 40%
*   more than 10 days ago: 70%

Each time a book is displayed, we roll the dices, and we only refresh it on a success. This moderates a lot the chance to be the unlucky visitor who clears all the caches.

As a bonus, here’s some details of the implementation; it’s a webapp, built with Laravel 8. Note that I simplified the code for clarity. The controller which displays a post could be written like this:

```php
class PostsController extends Controller
{    
    public function show(Post $post)    
    {        
        return view("post", [            
            "post" => $post->refreshBooks()        
        ]);   
    }
}
```

A `Post` has a `books` list, which is basically an array of books objects sent by the API (stored in a json column in MySQL). Here’s the `Post::refreshBooks()` code:

```php
public function refreshBooks(bool $force = false): self
{
    $this->update([
        "books" => collect($this->books)
            ->map(function ($book) use ($force) {
                return app(BookCache::class)->refreshIfNeeded($book);
            })
            ->toArray()
    ]);
    
    return $this;
}
```

This methods iterates over the `books` list, and each one is replaced by the result of a `BookCache::refreshIfNeeded()` method. The implementation is not really important here, but one thing to know is that an Eloquent model (Eloquent being the ORM used in this project) will not update itself if no change is detected. So if the cache simply returns the `$book` without any update, nothing would happen in the DB.

Finally the cache implementation is quite easy to follow:

```php
class BookCache {    

    public function refreshIfNeeded(Book $book): Book    
    {        
        if($this->shouldRefresh($book->refreshed_at)) {            
            return app(BookApi::class)->find($book->id);        
        }        
        
        return $book;   
    }
    
    private function shouldRefresh(Carbon $refreshedAt): bool    
    {        
        $diff = $refreshedAt->diffInDays(now());        
        
        if($diff <= 1) {            
            return false;        
        }        
        
        if($diff <= 3) {            
            return mt_rand(0, 99) < 20;       
        }        
        
        if($diff <= 10) {            
            return mt_rand(0, 99) < 40;       
         }        
         
         return mt_rand(0, 99) < 70;    
     }
 }
```

And with this, we have a simple system which handles the cache we need, and which is quite easy to parametrize (probabilities and steps could by defined in a config file, as a first step).

That’s it, please feel free to [catch me on twitter](https://twitter.com/dvlpp) for any comment or question on this.
