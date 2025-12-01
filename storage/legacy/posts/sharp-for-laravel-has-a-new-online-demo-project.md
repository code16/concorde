---
title: Sharp for Laravel has a new online demo project
description: >-
  Since version 4, Sharp companion demo / testing app, named Saturn, was kind of
  clumsy: it was hard to understand, as a new user, what was…
date: 2022-03-08
thumbnail: /assets/img/posts/sharp-for-laravel-has-a-new-online-demo-project/thumbnail.png
author: philippe
---

![](/assets/img/posts/sharp-for-laravel-has-a-new-online-demo-project/thumbnail.png)

Since version 4, Sharp companion demo / testing app, named Saturn, was kind of clumsy: it was hard to understand, as a new user, what was the purpose of each entity. And even worse: the code itself ended up being really bad, as it was made up of layers and additions over Sharp versions.

So we decided to start a new demo app from scratch, managing very boring but easy to understand entities: blog, post, block, author, and so on. This new demo app shows many Sharp features (not _all_ the features, by hey there are a lot): list, form, show, dashboard, single show, embedded lists, instance and entity commands (including a primary one), autocompletes, form lists (repeaters), uploads (with bulk), global page alert, permissions…

As before, the code is included in the repository (and ignored by composer when sharp is installed as a dependency) as documentation / example, and the app could be tested online, at this address: [**https://sharp.code16.fr/sharp**](https://sharp.code16.fr/sharp). It’s a real app with a database re-seeded once an hour.

![](/assets/img/posts/sharp-for-laravel-has-a-new-online-demo-project/1_XFdiLXq-Ik4AB9JJtxn8yw.png)

![](/assets/img/posts/sharp-for-laravel-has-a-new-online-demo-project/1_0iOuFoB42jPT7EqC6zBQjQ.png)

![](/assets/img/posts/sharp-for-laravel-has-a-new-online-demo-project/1_2UrWt-_q2Z3dwBuxBTVg1w.png)

Be sure to try it and to check the code, to see how things could be built in Sharp (at least in our way, at Code16); and if you don’t know Sharp already, that’s a good starting point! You can also check the documentation here: [**https://sharp.code16.fr**](https://sharp.code16.fr/sharp), and [reach me on twitter](https://twitter.com/dvlpp).
