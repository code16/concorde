---
title: A full app built with Sharp.
description: >-
  We used Sharp 8 as a framework to design a build a full management app. 
date: 2023-11-21
thumbnail: /assets/img/posts/a-full-app-in-sharp/thumbnail.png
author: philippe
---

You may know [Sharp](https://sharp.code16.fr) for Laravel: it’s a content management framework we develop, maintain and use a lot at Code 16, on top of or various websites and applications. And in fact, for a recent project, we decided to go full Sharp: the whole app is built with in.

## A quick presentation of the project

The client is [Bureau 132](https://www.bureau132.fr) a French company that helps businesses to find the ideal solution for their insurance needs. It’s quite specific, but you can think of it as an intermediate between companies and insurance brokers. To do so, they needed an online tool to help them manage their customers, their contracts, their brokers... and to manage the workflow of a request for quotes and quote selection.

Let’s list what an app like this needs to do:

 - authenticate users with different roles and permissions (admins, brokers, customers), and leverage an invitation system,
 - allow admins to list, create and update brokers, customers and requests for quotes (RFQ), with various data (rich presentation texts, uploads, dates...),
 - allow brokers to log in and answer to an RFQ: partially or entirely accept it (with a quote made of various uploads) or refuse it with a reason,
 - handle the RFQ workflow, from the state "draft" to "accepted" through "pending" (waiting for quotes) and others, with deadlines and targeted notifications sent at some points.

And of course: 

 - activity should be logged to be able to explain any situation from the start,
 - all the code should be properly tested to avoid regressions,
 - last but not least, the app must present a nice UI and a good and consistent UX.

## Why go with Sharp?

The list of features is fairly standard for a management app, but notice that it’s not a simple CRUD app: it has workflows, meaning actions can or can not be executed based on some state, it has notifications, it needs to look very plain and simple for some users (brokers and customers) and have all the features for admins, etc. Clearly, a CMS is not a good fit here.

But Sharp is not a simple CMS: it can surely display lists, show pages and forms, and handle various data structure; but it can also handle authentication, authorization, validation, file uploads, custom commands... it can even leverage 2FA authentication for admins since version 8, all of this with a simple and consistent UX. And looking from the code side, it’s a very productive way to build an app.

## The Sharp app

We added a dedicated section under the login form to handle a forgotten / create password feature (NB: this feature will finally be built in Sharp 9):

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/login.png)

From an administrator point of view, the RFQ list is really important, and can be filtered / searched / sorted in various ways:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/rfq-list.png)

The RFQ show page is also very important, and has a lot of information and actions, like the one allowing to upload and attach documents to contracts:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/rfq-show.png)

And above the quotes list, there is a wizard command to send invitation to all or selected brokers: 

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/notify-brokers.png)

The global search feature of Sharp is really useful to quickly open a broker, a customer or a RFQ:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/search.png)

Connected as a broker, the interface is lighter: no menu, no global search, and only the RFQ that were proposed to me are presented:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/broker-rfq-list.png)

The RFQ show page was also simplified, and directly embed my quote management:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/broker-rfq-show.png)

A full history context is filled and kept (for admins eyes only) for each RFQ and each quote:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/history.png)

Admins can enable TOTP 2FA for their account, in the app:

![The Sharp app](/assets/img/posts/a-full-app-in-sharp/2fa.png)

## So what?

This presentation is not complete, and I know that the seeded (French) dataset does not help to get the whole picture; but the idea of this post was to demonstrate that Sharp is a very good tool to create an admin / CMS section to any Laravel app, but may also be a good framework to build a full management app.

As always, feel free to [catch me on twitter](https://twitter.com/dvlpp) for any comment or question on this.
