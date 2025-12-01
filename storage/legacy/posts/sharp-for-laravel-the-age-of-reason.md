---
title: 'Sharp for Laravel: the age of Reason'
description: 'Sharp for Laravel has a new major version: Sharp 7.'
date: 2021-11-15
thumbnail: /assets/img/posts/sharp-for-laravel-the-age-of-reason/thumbnail.png
author: philippe
---

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/thumbnail.png)

Sharp 7 extends the effort of Sharp 6 to rely on better technical foundations, and to attempt to simplify the use of the package for newcomers. And as a bonus, it brings new features.

But first: if you are new to Sharp, it’s an open source package built for Laravel apps, which can be described as an admin panel framework: it allows you to build a custom admin section for content, users, orders of a shop, or anything else really. You can find resources [here in Medium](https://medium.com/code16/tagged/sharp), or of course on [Sharp’s website](https://sharp.code16.fr).

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__cJax__3E4iGUSIWFhM6wiaQ.png)

## Global code refactoring

I know you are not here to read this: the code refactoring, leading to many changes in many areas of the codebase, is not a topic for Sharp’s users.

But it seems to me that I should nevertheless mention it since it’s a big part of the ~400 commits of this release, and more importantly: it’s a sustainability commitment. Sharp is maintained to live a long time, since it is a the core of most (if not all) of our projects, at [Code 16](https://code16.fr/en). And a long life means code refactoring and dependencies upgrades.

## Work on the API

Let’s start with the downside of this: [the BC list is quite impressive](https://sharp.code16.fr/docs/guide/upgrading/7.0.html) (but it can definitively be done, we’ve already upgraded some big projects).

In some parts of the codebase, Sharp’s API (I mean the public API that the developer is dealing with while building Entity Lists, Show Pages, Forms, Dashboard, Commands…) was a not always consistent. And worse, sometimes I saw in projects some layout or config calls in the field building section, which can lead to vicious bugs.

So we rewrite parts of the API; of course everything is mentioned in the migration doc, and in the documentation itself, but let’s review some examples to show the spirit:

### Proxy objects

In Entity List, Show Page, Forms, Dashboard, Commands, to build fields or columns and define layout, Sharp require you to fill dedicated methods.

Here’s a code sample from Sharp 6:

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__1dTjiQeKrvI827XrNbmoeA.png)

The problem was that even with a good IDE autocompletion, the developer had to remember to use `$this->addField()` here, or `$this->addSection()` in the layout method.

In Sharp 7, all these methods have a new parameter: a dedicated proxy object which expose only the wanted methods, depending on the case:

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__zGFa6RSrBgO6j7BNe62Q__Q.png)

In the same way, to provide feedback on what can be done, Sharp 7 has a `buildXxxConfig()` method for almost every class type; and all configurable property as a setter starting with `configure...` :

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__xhADLCZPtj__zqyVemgbHyA.png)

Again, this brings clarity on what’s available to the developer.

### New way of declaring Commands and Filters

In Sharp 6, Commands (Entity Lists, Show Pages, Dashboards) and Filters (Entity Lists and Dashboards) were declared in the `buildXxxConfig()` method, mixed with all other configuration.

Sharp 7 introduce new dedicated methods:

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__t__MWMRlalntwdZ9D2OcFhA.png)

I think this adds readability; as a (great) bonus the previous mandatory “key” of a Command or a Filter is now optional, as you can use the class name as identifier.

### Query params are now available everywhere

This is a new feature, and an API change. Previously the `EntityListQueryParams` object (containing the filters, search words, pagination data… of the request) was a `getListData()` parameter. But sometimes you may need to maybe add or remove a column to the list, or change the available Command list based on the user selection; that’s why now it’s an instance property of the EntityList’s class instead.

Here’s an example of such a case, where depending on a “role” filter we choose to display or not columns:

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__Rn6h0PoU7VH8LmRUU7meTQ.png)

(This example was taken from Saturn, Sharp’s demo project, [which is available online](https://sharp.code16.fr/sharp/s-list/pilot)).

## New features (finally!)

In order not to be called Sharp Snow Leopard, this release adds new features, and quite big ones.

### New Editor

This is the main one, which can seem at first glance quite small or invisible, but really is very important. It is basically a full replacement of Markdown and Wysiwyg form fields, based on Simple MDE and Trix, with a new custom text editor based on the great [tiptap](https://tiptap.dev).

The new `SharpFormEditorField` has the same features than the old editors, plus new ones: a good support for tables, iframes and raw html blocks for instance. But more importantly, it will now really feel like a wysiwyg editor, without markdown markup (even if you still can use markdown as storage format) but keeping the crucial function of separating content and form.

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__Ydk8Yp__mSb86QnErT37PCw.png)

And behind the scene, this new editor allows us to plan cool new features for future releases.

### Original image preservation

Images uploaded as embeds of the text editor or in a `SharpFormUploadField` can be edited: cropped or rotated. With Sharp 7, you can now decide to leave the original uploaded image untouched; this means your users be able to modify a crop area as many times as they want.

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__y6eDkC__S1r5b41V1mpENiA.png)

### Global Page alert

This was a [feature request](https://github.com/code16/sharp/issues/306) of [Insolita](https://github.com/Insolita) that we found very interessant: implement the ability to add a custom global text above an Entity List, a Show Page, a Form or even a Command Form.

Since the global page alert is treated like a field, with a template which can be populated with the current data, it can be use in many situation to provide context or help to the user.

![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__oR6jbc1Lqwt1AC__pgnz6Ag.png)
![](/assets/img/posts/sharp-for-laravel-the-age-of-reason/1__1hlT8s8vLl8EHEquoRJBbQ.png)

### New Command return: streamDownload

As this was a quite common request, we added a way to return a file stream in a Command execute method, removing the need to store the file, which can be lighter in some situations.

## That’s it for now

We do have plans for future releases; we are working on a way to embed any kind of applicative content in a `SharpFormEditorField`, possibly in a future 7 minor release, among other stuff.

If you want to give Sharp 7 a try, [start here](https://sharp7.code16.fr/docs/guide/) (Sharp 7 is in beta when writing this, but this should change quickly)—of course, Sharp is still and will remain an open source project. You can reach me via the comment section, of more efficiently via [my twitter account](https://twitter.com/dvlpp).
