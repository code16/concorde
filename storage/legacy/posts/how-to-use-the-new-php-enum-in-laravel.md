---
title: How to use the new PHP enum in Laravel
description: >-
  PHP 8.1 introduced long awaited support for built-in Enums. There is no more
  need for custom solutions as Since 8.69 Laravel has your back.
date: 2022-01-12
thumbnail: /assets/img/posts/how-to-use-the-new-php-enum-in-laravel/thumbnail.jpg
author: arnaud
---

![](/assets/img/posts/how-to-use-the-new-php-enum-in-laravel/thumbnail.jpg)

PHP 8.1 introduced long awaited support for built-in [Enums](https://php.watch/versions/8.1/enums). There is no more need for [custom solutions](https://github.com/spatie/laravel-enum) in your Laravel projects since Laravel with its [8.69 release](https://laravel-news.com/laravel-8-69-0) has your back.

We’ll take a really simple example of a blogpost model with a publication state that can be draft or published. As it will be stored in database, we used a “backed” Enum. It means that each value is associated with a string.

```php
namespace App\Enums;  
  
enum BlogpostState: string  
{  
    case DRAFT = 'state_draft';  
    case PUBLISHED = 'state_published';  
}
```

### Entity model

When creating your database schema, you can use eloquent’s“string” type for the state column as it will store the Enum’s backed value as a string: ‘state_draft’ or ‘state_published’.

```php
public function up()  
{  
    Schema::create('blogposts', function (Blueprint $table) {  
        ...  
        $table->string('state');  
    });  
}
```

Now comes the great part. You can use the new [casting](https://laravel.com/docs/8.x/eloquent-mutators#enum-casting) in your Blogpost model and it allows your state model attribute to be casted to/from an Enum:

```php
namespace App\Models;

class Blogpost extends Model  
{  
    protected $casts = [  
       'state' => BlogpostState::class,  
    ];

}
```

Then you’ll get the enum when interacting with the state attribute:

```
>>> dd($blogpost->state);  
=> App\Enums\BlogpostState {  
     +name: "DRAFT",  
     +value: "state_draft",  
   }
```

So for example you can now compare the state to the Enum directly:

```php
public function isPublished()  
{  
    return $this->state === BlogpostState::PUBLISHED;  
}
```

Or access the backed value stored in database if needed:

```
>>> dd($blogpost->state->value);  
=> "state_draft"
```

Also if you try to create or update a blogpost with an invalid state value, you’ll get an immediate PHP error:

```
>>> $blogpost->update(['state' => 'state_foo']); 
=> PHP Error: "state_foo" is not a valid backing value for enum 
"App\Models\Enums\BlogpostState"    
```

The state’s enum can have methods,

```php
public function label(): string  
{  
    return match($this)  
    {  
        self::_DRAFT_ => 'Draft...',  
        self::_PUBLISHED_ => 'Published!',  
    };  
}
```

that could be used directly with your model:

```
>>> $blogpost->state->label();  
=> "Draft..."
```

### Validation rule

When you want to make sure an input match an enum, you can use a new laravel [rule](https://laravel.com/docs/8.x/validation#rule-enum):

```php
namespace App\Http\Requests;

class BlogpostRequest extends FormRequest  
{  
    public function rules()  
    {  
        return [  
            "state" => [  
                 "required",  
                 new Enum(BlogpostState::class)  
            ],  
        ];  
    }  
}
```

And it’s pretty straightforward. Now your request only accept enum’s backed values: ‘state_draft’ or ‘state_published’.

![](/assets/img/posts/how-to-use-the-new-php-enum-in-laravel/field.png)

### Factory

Also, when you want to seed a blogpost, you can now use enum directly in your factory:

```php
namespace Database\Factories;  
  
class BlogpostFactory extends Factory  
{  
    public function definition()  
    {  
        return [  
            ...  
            'state' => BlogpostState::DRAFT,  
        ];  
    }  
}
```

### Route bindings

Since Laravel 9, there is now implicit route binding with enum. So you can type-hint your enum and Laravel will automatically cast the string value from the URL :

```php
Route::get('/blog/{state}', function(BlogpostState $state) {  
    // here $state is an enum instance  
});
```

In our example, both

*   https://mysite.com/blog/state_draft
*   https://mysite.com/blog/state_published

are valid URLs. But if URL does not match any of the enum’s values, you’ll get a 404 error (Ex: https://mysite.com/blog/state_foo).

I think we’re done here. Thanks for reading !
