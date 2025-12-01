---
title: 'Sharp 6 for Laravel: new UI, breadcrumb and refinements'
description: >-
  Six months after a v5 which was mainly a technical bump, Sharp for Laravel
  hits version 6, and this time there are new features (along…
date: 2021-04-13
thumbnail: /assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/thumbnail.png
author: philippe
---

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/thumbnail.png)

Six months after a v5 which was mainly a technical bump, Sharp for Laravel hits version 6, and this time there are new features (along with many code refactoring, but let’s be honest, who cares?).

For this blog post I postulate that you already know what Sharp for Laravel is; if this not the case [you can start here](https://sharp.code16.fr), where you’ll find a presentation, the documentation and a live demo. And if you want to read this post first, no problem: in short, Sharp is an open source package, built for Laravel apps, which can be described as an admin panel framework, allowing you to build a custom admin section for content, users, orders of a shop, or anything else.

## New design!

The most obvious change is that we updated the design of… everything. Here’s how Sharp looks now (in latino-french, sorry for that):

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__zV6nmiGmiRYnt__H__Za2plg.png)
![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__umatOydbq5pEPik3T1iUgA.png)

And there is more on customization: it was already possible to define a PNG as logo, but now with some CSS magic you can configure a primary color, which will affect all the UI:

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__nGERot3bzxoXX86qj0PB5g.jpeg)

## Breadcrumb

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__AnEYtUGB6qsGN2msARji7w.png)

This may seem small, but behind this word we hide a completely rewritten navigation and context management. With show pages and embedded entity lists, it’s now easy to build a real hierarchical navigation; consider this real world example, for some kind of formation center: we handle courses which can have multiples sessions, and each session has a list of registrants:

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__PK3akMeuKLH0plNlPzXd__g.gif)

With Sharp 6, it’s natural to allow your user to navigate through a hierarchical organization of data, as the functional domain is.

For another real example, you can look at [Formoj](https://github.com/code16/formoj) (an open source package focused on form generation that we are maintaining at Code 16), which can optionally be attached to Sharp for form building and answers export: in Sharp 5 we had 3 entities in the main menu: Forms, Fields, Answers.   
With Sharp 6, we only kept Forms, with an embedded entity list of Fields and another for Answers, and everything is way easier to handle and understand for the user.

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__wuTjD0KEj1__lb1GeaQCy9w.png)

And as always with Sharp, you have control on how data is presented to the user: each breadcrumb item label can be personalized, depending on the actual instance data.

The new Breadcrumb feature is [documented here](https://sharp.code16.fr/docs/guide/sharp-breadcrumb.html), along with [embedded entity lists](https://sharp.code16.fr/docs/guide/show-fields/embedded-entity-list.html#embedded-entitylist) (which exist since a while).

## Primary commands

Commands are of course very common in Sharp. Entity commands are meant to apply on a set of instances: it can be an order export in CSV, or some bulk update action for instance.

In Sharp 6 you can define one Entity command as “primary”: in this case the command is extracted to its own button, at the top of the list, right next to the creation action. This can have various usages, mainly promote a common / important action, but one seems particularly useful: if this command defines a form (which will open in a modal on click), and if you hide the create button (with a simple authorization configuration), you can define your own creation workflow, apart from update, with a clear UI—could be an invitation system for a user, for instance.

![](/assets/img/posts/sharp-6-for-laravel-new-ui-breadcrumb-and-refinements/1__EhACVlFj4FMUYm4cyRqL4Q.png)

## And more…

Show pages can define collapsible sections; markdown field can now embed any file type (and not only images), with control on how you display those; and it’s now possible to redirect to a show page after an entity creation.

The release notes [are on Github](https://github.com/code16/sharp/releases/tag/v6.0.0), and the [upgrade documentation is here](https://sharp.code16.fr/docs/guide/upgrading/6.0.html) (with breaking changes, yes… in part because moving forward we dropped support for PHP 7.3 and below, and fully embraced the PHP 7.4+ type hitting system).

Feel free [to reach me on twitter](https://twitter.com/dvlpp) if you have questions or remarks about this release, and happy coding.
