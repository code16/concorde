---
title: Introducing Ozu, a static website deployment solution for Laravel projects.
description: >-
  Ozu allows to build and deploy a static website from a standard Laravel codebase, providing the CMS section and more.
date: 2024-05-23
thumbnail: /assets/img/posts/introducing-ozu-a-static-website-deployment-solution-for-laravel-projects/thumbnail.jpg
author: philippe
---

![Ozu](/assets/img/posts/introducing-ozu-a-static-website-deployment-solution-for-laravel-projects/ozu.jpg)

In the past few months we built a project, at Code 16, that we found very useful to build and deploy static websites. We weren't very happy with the existing solutions, so we decided to create our own product with three main goals in mind: keep our Laravel stack, handle all the deployment stuff and allow our customer to manage their content. 

We called it [Ozu](https://ozu.code16.fr); since it begins to be in a good state we decided to got for a product with this, and today is the presentation day with a [product landing page launch](https://ozu.code16.fr).

It’s quite a big deal for us, and to be honest it still requires some work, but we think that Ozu is mature enough to onboard some early beta testers.

## But first, the why

For some projects, static websites are a good fit: they are fast, secure, and easy to maintain — for all this, we love them at Code 16. The usual drawbacks are also well known: there is no content management, they can be complex to deploy, and they often require a different stack than a regular Laravel project. 

There are solutions to address this (Netlify Create, Statamic in some cases, etc.), but they were not always a good fit for us. We wanted to be able to build a website as a regular Laravel project and deploy it as a static website on a Netlify space, or even on any server.

And as a big bonus, we want to allow our customers to manage the content of their website in a dedicated CMS, without too much compromises. So that’s why we built Ozu.

## The what and the how

Here’s a quick overview of what Ozu is, and how it can be used:

**The first component is a Laravel package** (`code16/ozu-client`) that you need to install on your project; the main impact is to add a trait in your models, and some custom methods to build the CMS part:

```php
class Project extends Model
{
    use IsOzuModel;

    public function visuals(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('model_key', 'visuals')
            ->orderBy('order');
    }

    public static function configureOzuCollection(OzuCollectionConfig $config): OzuCollectionConfig
    {
        return $config
            ->setLabel('Projects')
            ->setIcon('fa-ruler-combined')
            ->setHasPublicationState()
            ->setIsCreatable()
            ->setIsDeletable(false);
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config
            ->addColumn(OzuColumn::makeImage('cover'))
            ->addColumn(OzuColumn::makeText('title')->setLabel('Title'))
            ->addColumn(OzuColumn::makeText('place')->setLabel('Place'))
            ->addColumn(OzuColumn::makeText('year')->setLabel('Year'))
            ->setIsSearchable()
            ->setIsReorderable();
    }

    public static function configureOzuCollectionForm(OzuCollectionFormConfig $config): OzuCollectionFormConfig
    {
        return $config
            ->addCustomField(
                OzuField::makeText('place')
                    ->setLabel('Place')
                    ->setValidationRules(['required'])
            )
            ->addCustomField(
                OzuField::makeText('year')
                    ->setLabel('Year')
                    ->setValidationRules(['required', 'integer'])
                    ->setHelpMessage('Year of the project')
            )
            ->addCustomField(
                OzuField::makeImageList('visuals')
                    ->setLabel('Visuals')
                    ->setMaxItems(5)
            );
    }
}
```

An Ozu model has a few base fields (cover, title, content...), and as you can see in the code above you can declare more of them if needed.

**You can then develop the website as usual** using blade views, controllers, routes, Eloquent models, migrations, seeder, factories...

When your project is ready, the next step would be to create an Ozu account, to get a proper token and to run an artisan command to **initialize the project on the Ozu side**:

```bash
php artisan ozu:configure-cms
```

After this command you’ll be able to access to the Ozu dashboard of your project, where you can manage the production content of your models:

![The project form](/assets/img/posts/introducing-ozu-a-static-website-deployment-solution-for-laravel-projects/sharp.jpg)

The final step is to **deploy it to its real hosting space** of your choice: once configured, it will be a one-click operation from Ozu:

![Publication](/assets/img/posts/introducing-ozu-a-static-website-deployment-solution-for-laravel-projects/deploy.jpg)

The idea is to let the content manager decide when to deploy: once the content is ready, they can publish it to the production space.

## The when

Ozu is a working piece of software that we are in fact already using on some production projects, but it’s still in beta: we are looking for early testers to get more feedback, and we are planning to launch the first public version in a few months.

If you feel that **Ozu could be a good fit for one of your projects and if you want to test the product**, or if you want to be notified when we launch it, you can simply [subscribe to the newsletter here](https://ozu.code16.fr/#join).

That’s it for now; feel free to [catch me on Twitter/X](https://x.com/dvlpp) or directly by mail (philippe at code16.fr) for any comment or question on Ozu.
