---
title: Sharp 7 for Laravel is released
description: 'The beta has ended, with a final refactoring on entities and menu declaration'
date: 2022-01-03
thumbnail: /assets/img/posts/sharp-7-for-laravel-is-released/thumbnail.png
author: philippe
---

![](/assets/img/posts/sharp-7-for-laravel-is-released/thumbnail.png)

This new year starts for us with the release of Sharp 7.0, after ~8 weeks of beta, and many bugs fixed in the process. Almost all new features and stuff were presented in the dedicated post written in November, so I encourage you to read this first:

👉 [Sharp for Laravel: the age of Reason](/posts/sharp-for-laravel-the-age-of-reason)

> To find out more about Sharp 7, [start here](https://sharp.code16.fr/docs/); you’ll find the documentation (note that Sharp 6 documentation is still available), and an online demo; and you can [join us on Discord](https://discord.com/invite/sFBT5c3XZz) to find help or to start a discussion.

## But wait, what has changed since the beta?

One thing, one final (quite big) refactoring was merged, _without new breaking change_, aiming to shrink Sharp config file, with success, and also leading to add control over entity and menu declaration, and to refactor dusty parts of the codebase.

From a developper perspective, this allows to change this `config/sharp.php` file (from Sharp 6):

![](/assets/img/posts/sharp-7-for-laravel-is-released/1__fwkntRytMkYbCJrbuHGoFA.png)

… into this in Sharp 7, which is in my opinion a lot more easy to read and understand:

![](/assets/img/posts/sharp-7-for-laravel-is-released/1__ros5YvBAw27C735uP9dLFg.png)

All the config is moved to classes, with new APIs to declare entities and menu, which is more convenient (IDE autocomplete), readable and flexible — since you can, for instance, decide to bind a different Form for an entity depending on the user.

All of this is documented in detail, but here’s an example of a simple entity class, just to show that it can be almost as small as a config array:

![](/assets/img/posts/sharp-7-for-laravel-is-released/1__jKldc474QRIHRpAw2__tbvw.png)

And it is way easier to build the menu with the new expressive API:

![](/assets/img/posts/sharp-7-for-laravel-is-released/1__sda__MqRxW1viewVTV3akSg.png)

But you can argue that one single config file in quicker to build in case of a small project; because of this (and to avoid breaking change) and even if this new way of declaring entities and menu is heavily recommended for new project, the config-based method is still supported.

That’s it; we at Code 16 hope you’ll enjoy Sharp 7; we use it daily on our projects, and very much intend to keep it open source like today. For any Sharp related question, feel free [to reach me on twitter](https://twitter.com/dvlpp).
