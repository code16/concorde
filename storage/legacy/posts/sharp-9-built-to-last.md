---
title: Sharp 9, built to last.
description: >-
  The v9 is mainly focused on technical improvements, but it also brings nice new features. 
date: 2024-12-17
thumbnail: /assets/img/posts/sharp-9-built-to-last/thumb.png
author: philippe
---

In the release post of [Sharp 8](https://code16.fr/posts/sharp-8-for-laravel-is-here/), last year, I mentioned that we were already working on the v9, and that it would be an ambitious technical release, without new features. It was indeed ambitious, and it took us a bit more time than expected, but it’s finally here! and good news: it also brings some great new features.

## Inertia, Tailwind CSS and shadcn/ui

![](/assets/img/posts/sharp-9-built-to-last/pr.png)

We rewrote A LOT of code. 

The front part of Sharp is now built with [Inertia.js](https://inertiajs.com/), for the better: we preserved the powerful breadcrumb system of Sharp, while managing to remove a lot of complexity due to the json-based API, making the code more maintainable and more testable. On the DX side, it’s also a big win, as it’s now easier to debug functional code with your regular tools (Xdebug, `dd()`...).

We also took the opportunity to switch to [Tailwind CSS](https://tailwindcss.com/) and to leverage [shadcn/ui](https://ui.shadcn.com) to entirely rebuild Sharp’s UI: every filter, form field, dialog was rewritten leading to, we think, a big improvement in terms of consistency and design.

## Refactoring of uploads and form validation

On the backend side, we refactored the way uploads are handled, and without breaking changes, it allows us to add upload validation (file size, dimensions) and a new fluent thumbnail API. 

But more importantly, it leads us fixing an old pain point: form input validation was handled **before** field formatting in 8.x because of upload related constrains, leading to annoyances for the developer like the delayed creation (if you know, you know). This is now fixed, and form validation is now done after formatting, which is a much more logical and powerful way to handle it.

As a bonus input validation can be part of the Form class in 9.x which often leads to a more readable code and less boilerplate.

## Developer experience (DX) improvements

This release is really DX-focused, as we made a lot of improvements in this area:

### New code-based configuration system 

No more `config/sharp.php` file.

```php
class SharpServiceProvider extends SharpAppServiceProvider
{
    protected function configureSharp(SharpConfigBuilder $config): void
    {
        $config
            ->setName('Demo project')
            ->addEntity('posts', PostEntity::class)
            ->addEntity('blocks', PostBlockEntity::class)
            ->setSharpMenu(SharpMenu::class)
            ->setThemeColor('#004c9b')
            ->setThemeLogo('/img/sharp/logo.svg')
            ->enableImpersonation();
    }
}
```

### New artisan commands to generate resources with prompts

With a new `sharp:install` command to get started quickly:

```bash
➜  php artisan sharp:install

   INFO  Provider [app/Providers/SharpServiceProvider.php] created successfully.
   INFO  Sharp assets published.
   INFO  Sharp assets autoload script added to composer.json.
   INFO  Sharp assets added to .gitignore.
   INFO  Menu [app/Sharp/SharpMenu.php] created successfully.
   INFO  Sharp has been installed! You can now generate your first Sharp Entity with [php artisan sharp:generator].
```

### Built-in impersonation system on dev environment

![](/assets/img/posts/sharp-9-built-to-last/impersonation.png)

### And more...

- no more Vue templates (autocomplete, page alerts...): **everything is now in Blade**
- no more dependence towards Font Awesome, as we now leverage `blade-ui-kit/blade-icons` allowing you to **use many icon sets**
- new performance system to **memoize instances in Entity Lists** (to spare DB queries)
- **improved Editor field**: add custom embeds in the toolbar and allow legend on uploads

## New user features

The idea was not to add features on this version, but since the new code organization allowed us to do it quite easily, we added some nice things:

### New UI

While it’s not technically a feature it’s worth mentioning it: the new UI is more consistent, more modern, more accessible and more responsive.

![](/assets/img/posts/sharp-9-built-to-last/ui.png)

### Forgotten password 

Really built-in, like the 2FA: should only be a matter of configuration.

### New quick creation system

Allow your user to create an instance from the List page, in a modal, without adding any code but relying on your regular Form implementation.

<video width="1302" height="836" controls class="mb-6">
    <source src="/assets/img/posts/sharp-9-built-to-last/quick-create.mp4" type="video/mp4">
</video>

### Dark mode!
  
![](/assets/img/posts/sharp-9-built-to-last/dark-mode.png)

## How to upgrade?

First, at the time of writing this blog post, Sharp 9 is still in beta: make sure not to use it in production yet (we are confident that a stable version will be released soon).

Next, let's be honest, upgrading from 8.x to 9.x will require some work given that we touched many parts of the package. But we tried to ease the pain as much as possible, and we wrote a [dedicated upgrade guide](https://sharp9.code16.fr/docs/guide/upgrading/9.0) to help you through the process.

And **if you are new to Sharp**, well, this announcement post is not a good starting point: maybe you can read this old but still relevant [introduction post](https://code16.fr/posts/leveraging-sharp-laravel-open-source-content-management-framework/), and go to [Sharp’s website](https://sharp.code16.fr) to check the online demo, and get started with the documentation. 

## What’s next?

Sharp 9 represents a very solid foundation for the future, and we are already planning for new features in the 9.1 version. You can stay tuned joining the [Discord server](https://discord.com/invite/sFBT5c3XZz), or following this blog; and you can reach me directly at philippe [at] code16.fr (as I'm quietly quitting X/Twitter) for any particular question or feedback.
