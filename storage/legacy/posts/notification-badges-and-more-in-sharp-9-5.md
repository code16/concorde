---
title: Notification badge and more in Sharp 9.5
description: >-
  Quick recap on all the new features added since version 9.0  
date: 2025-06-04
thumbnail: /assets/img/posts/notification-badge-and-more-in-sharp-9-5/thumb.png
author: philippe
---

Since its [release in December 2024](https://code16.fr/posts/sharp-9-built-to-last/), development on [Sharp 9](https://sharp.code16.fr) has continued steadily, with numerous bug fixes and a range of new features. I wanted to write a quick review of some of the most notable additions.

## Three simple additions enabling a complete notification badge system

As with many parts of Sharp, this feature was designed based on real-world needs, with simplicity and developer experience (DX) as guiding principles. The goal was to allow displaying a notification badge directly in the menu — for example, to indicate new orders to process, new users to approve, or articles awaiting validation. 

After a few iterations, we found the best approach was to introduce a badge parameter on the menu item:

```php
// [...] Imports hidden for brevity

class MySharpMenu extends SharpMenu
{
    public function build(): self
    {
        return $this
            ->addSection('Blog', function (SharpMenuItemSection $section) {
                $section
                    ->addEntityLink(
                        entityKeyOrClassName: PostEntity::class,
                        label: 'Posts',
                        icon: 'lucide-file-text',
                        badge: fn () => Post::where('state', 'draft')->count() ?: null,
                    );
            });
    }
}
```

![A simple number badge in the menu item, showing the number of draft posts.](/assets/img/posts/notification-badge-and-more-in-sharp-9-5/menu-badge.png)

![This system also allows text badges.](/assets/img/posts/notification-badge-and-more-in-sharp-9-5/menu-badge-new.png)

This is effective, but still somewhat limited. Previously, the common way to highlight such information was through dashboard widgets, a heavier solution that often felt like overkill. But it did offer a key advantage: it could link users directly to the relevant data (the entity list of  posts in draft state)

To bridge this gap, we added two new parameters: `badgeLink`, to define where the badge should lead when clicked, and `badgeTooltip`, to provide additional context:

```php
// [...] Imports hidden for brevity

class MySharpMenu extends SharpMenu
{
    public function build(): self
    {
        return $this
            ->addSection('Blog', function (SharpMenuItemSection $section) {
                $section
                    ->addEntityLink(
                        entityKeyOrClassName: PostEntity::class,
                        label: 'Posts',
                        icon: 'lucide-file-text',
                        badge: fn () => Post::where('state', 'draft')->count() ?: null,
                        badgeLink: fn () => LinkToEntityList::make(PostEntity::class)
                            ->addFilter(StateFilter::class, 'draft'),
                        badgeTooltip: 'Posts in draft state to validate',
                    );
            });
    }
}
```

With this enhancement, clicking the badge leads the user directly to the filtered list of draft posts. A big improvement, but we still felt something was missing: if a user clicks the menu item itself (not the badge), they end up on the full, unfiltered list, without any context related to the badge, which can be confusing. A good solution to solve this is to leverage the [global page alert system](https://sharp.code16.fr/docs/guide/page-alerts#add-global-page-alert), and we enhanced it with support for links:

```php
// [...] Imports hidden for brevity

class PostList extends SharpEntityList
{
    protected function buildPageAlert(PageAlert $pageAlert): void
    {
        if (($count = Post::where('state', 'draft')->count()) > 0) {
            $pageAlert
                ->setMessage(sprintf('%d posts are still in draft', $count))
                ->setButton(
                    'Show drafts',
                    LinkToEntityList::make(PostEntity::class)->addFilter(StateFilter::class, 'draft')
                );
        }
    }
    
    // All the remaining code is hidden for clarity
}
```

And voilà:

![A page alert with a link to the entity list of posts in draft state.](/assets/img/posts/notification-badge-and-more-in-sharp-9-5/page-alert.png)

Finally, we wanted to bring this sense of “notification” directly into the entity list view itself. The widely adopted pattern for this is a small dot at the beginning of each relevant row. Again, we implemented this in a Sharp-specific, flexible way using a new `EntityListBadgeField`:

```php
// [...] Imports hidden for brevity

class PostList extends SharpEntityList
{
    protected function buildList(EntityListFieldsContainer $fields): void
    {
        $fields
            ->addField(
                EntityListBadgeField::make('is_draft')
                    ->setTooltip('This post is draft')
            )
            ->addField(
                // More fields...
            );
    }

    public function getListData(): array|Arrayable
    {
        return $this
            ->setCustomTransformer('is_draft', fn ($value, Post $instance) => $instance->isDraft())
            ->transform(Post::paginate(20));
    }
    
    // All the remaining code is hidden for clarity
}
```

Here’s the result:

![A badge field in the entity list, showing a dot for draft posts.](/assets/img/posts/notification-badge-and-more-in-sharp-9-5/notification-dot.png)

Importantly, **each of these three features works independently**: you can use the menu badge without the page alert, or show inline notification dots without either of the other features.

If you want to see this in action, check out the [demo application](https://sharp.code16.fr/sharp/s-list/post) — all the code examples above come directly from it.

## Introducing the remote autocomplete filter

Filters are a core feature in Sharp, but the standard “select” filter can become unwieldy when the list of options is large — or worse, when those options aren’t known ahead of time. That’s why we introduced the [remote autocomplete filter](https://sharp.code16.fr/docs/guide/filters#autocomplete-remote-filter), allowing for dynamic searching via a callback:

```php
// [...] Imports hidden for brevity

class ProductCategoryFilter extends AutocompleteRemoteFilter
{
    public function buildFilterConfig(): void
    {
        $this
            ->configureLabel('Category');
    }
    
    public function values(string $query): array
    {
        return ProductCategory::orderBy('label')
            ->where('label', 'like', "%$query%") // Naïve search, but you can use any logic here
            ->pluck('label', 'id')
            ->toArray();
    }

    public function valueLabelFor(string $id): ?string
    {
        return ProductCategory::find($id)?->label;
    }
}
```

The result is very expected (here’s the filter is titled “Attachment” but you get the idea):

<video controls muted width="100%">
  <source src="/assets/img/posts/notification-badge-and-more-in-sharp-9-5/remote-autocomplete-filter.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>

## Profile picture — the Sharp way

Until now, the user menu lacked support for profile pictures. That’s now fixed, thanks to the new `->setUserAvatarAttribute(string|Closure)` setting in [Sharp’s configuration](https://sharp.code16.fr/docs/guide/authentication#configure-user-attributes), which accepts either a URL or a callback.

## Entity autodiscovery and more DX improvements

The new standard for declaring entities in Sharp is… not to! Thanks to [autodiscovery](https://sharp.code16.fr/docs/guide/entity-class#autodiscovery), you can reduce boilerplate significantly.

Other DX-focused improvements include the ability to:

- Use a closure as a template for autocomplete fields ([docs](https://sharp.code16.fr/docs/guide/form-fields/autocomplete#common-configuration-for-both-modes)).
- Display an info message and reload the page after a Command ([docs](https://sharp.code16.fr/docs/guide/commands#command-return-types)).
- Run Sharp apps with Laravel Octane for improved performance.

## What’s next?

There are still areas we’d like to improve in Sharp: multiforms, wizards, dashboard graphs... and we have plenty of ideas in the pipeline for new features.

If you’d like to get involved, you’re welcome to join the [Discord server](https://discord.com/invite/sFBT5c3XZz), or to contribute directly on GitHub. And if you have questions or feedback, feel free to email me at philippe [at] code16.fr (as I’m quietly quitting X/Twitter).

