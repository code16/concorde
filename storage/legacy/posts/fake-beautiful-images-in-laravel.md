---
title: Fake beautiful images in Laravel
description: >-
  If you seed your local database with model factories, you probably use the
  fresh faker library (as the original faker library has been…
date: 2021-09-10
thumbnail: /assets/img/posts/fake-beautiful-images-in-laravel/thumbnail.jpg
author: arnaud
---

![](/assets/img/posts/fake-beautiful-images-in-laravel/thumbnail.jpg)

If you seed your local database with [model factories](https://laravel.com/docs/8.x/database-testing#defining-model-factories), you probably use the [fresh faker](https://github.com/fakerphp/faker) library (as the [original faker](https://github.com/fzaninotto/Faker) library has been [deprecated](https://marmelab.com/blog/2020/10/21/sunsetting-faker.html)). And if you need some random images to populate you pages, the faker library has [your back](https://fakerphp.github.io/formatters/image/).

```php
namespace Database\Factories;  
  
use App\Models\Media;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class MediaFactory extends Factory  
{  
    protected $model = Media::class;  
  
    public function definition()  
    {  
        $fakerFileName = $this->faker->image(  
            storage_path("app/data"),  
            800,  
            600  
        );  
  
        return [  
            ...  
            'url' => $this->faker->imageUrl(800,600),  
            'file_path' => "app/data/" . basename($fakerFileName),  
        ];  
    }  
}
```

Once seeded, you got all your medias populated with placeholders. By default they come from a service called [placeholder.com](https://placeholder.com/). Your image urls look something like :

```
https://via.placeholder.com/800x600.png/00aaee?text=debitis
```

It works perfectly. But even as a backend dev, I must admit : it is a visual pain.

![](/assets/img/posts/fake-beautiful-images-in-laravel/placeholders.png)

Thankfully, there is a service providing beautiful photos for free called [picsum](https://picsum.photos). And you can benefit from it, with an [additional faker provider](https://github.com/smknstd/fakerphp-picsum-images). Here is a quick way to set it up.

First, add the package as a dev dependency:

```
composer require --dev smknstd/fakerphp-picsum-images
```

Then you can generate a new Laravel service provider via the artisan command:

```
php artisan make:provider FakerServiceProvider
```

Inside add a singleton, that loads the given provider to the faker :

```php
use Faker\{Factory, Generator};  
use Illuminate\Support\ServiceProvider;  
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;  
  
class FakerServiceProvider extends ServiceProvider  
{    public function register()  
    {  
        $this->app->singleton(Generator::class, function () {  
            $faker = Factory::create();  
            $faker->addProvider(new FakerPicsumImagesProvider($faker));  
            return $faker;  
        });  
    }  
}
```

Now we should register this provider. Ideally it should be conditional and probably don’t be registered on production environment. So in your “AppServiceProvider” you could add something like :

```php
public function register()  
{  
     ...

     if (!$this->app->environment('production')) {  
         $this->app->register('App\Providers\FakerServiceProvider');  
     }  
}
```

And … you’re done. Now every time, you’ll create a new media with model factory you’ll get a nice random photo instead of an ugly placeholder. Your urls now look like this :

```
https://picsum.photos/800/600?random=12965
```

And your pages could look something like:

![](/assets/img/posts/fake-beautiful-images-in-laravel/images.png)

Much better, right ?

There are also some more options. You could get the specific photos with its id instead of a random one. You could also ask for webp file format or add filters like grayscale or blurry effect.

![](/assets/img/posts/fake-beautiful-images-in-laravel/images-black-white.png)

That’s all for today. Happy faking !
