---
title: Validating critical email address in Laravel
description: >-
  Learn how to validate email address from your customers and make sure you can
  contact them with confidence with Laravel’s power feature
date: 2022-03-17
thumbnail: /assets/img/posts/validating-critical-email-address-in-laravel/thumbnail.jpg
author: arnaud
---

When you send critical messages to customers, you need to store a reachable email address. If a customer did pay for something you need to send him later like a gift card, you’ll be embarrassed to get an error like this:

```
Client error: `POST https://api.mailgun.net/v3/ambianceetstyles.com/messages.mime` 
resulted in a `400 Bad Request` response:  
{"message":"to parameter is not a valid address. please check documentation"}
```

Fortunately, Laravel provides a great validation feature that lets you validate incoming data including emails, so you’ll be able to contact your customers by email with confidence. Laravel includes a great [“email” rule](https://laravel.com/docs/9.x/validation#rule-email), that is based on a popular [php package](https://github.com/egulias/EmailValidator). With this rule, you can specify different validation strategies.

### Space character

Apparently RFC specifications allows email to have space characters in them. But with most email providers, it just won’t work. You should not accept those emails (and it probably is a wrong keyboard input). To do so, you need to add “filter” to your email rule:

```php
request()->validate([  
    "my_email_field" => [  
        "required",  
        "email:rfc,filter",  
    ],  
]);
```

Now, when an email contains a space character, you’ll get a nice validation error:

![](/assets/img/posts/validating-critical-email-address-in-laravel/thumbnail.png)

### DNS Check

Validation rule also has an interesting “dns” option that will check if there are DNS records that confim the given server accepts emails. This does not give a complete guarantee that the email address exists, but it is better than nothing.

The downside is that it will perform this check even in your dev environment including your automated tests. And it can make them **really slow.** So here is a trick to remove the dns check from your tests with a custom rule :

```php
namespace App\Rules;  
  
use Illuminate\Contracts\Validation\Rule;  
use Illuminate\Support\Facades\Validator;  
  
class MyCustomEmailRule implements Rule  
{  
    public function passes($attribute, $value)  
    {  
        $validator = Validator::make([$attribute => $value], [  
            $attribute => app()->environment('testing') ? 'email' : 'email:rfc,dns,filter',  
        ]);  
  
        return !$validator->fails();  
    }  
  
    public function message()  
    {  
        return "The email must be a valid email address.";  
    }  
}
```

Now every time you need to validate an email address you should use the custom rule:

```php
request()->validate([  
    "my_email_field" => [  
        "required",  
        new MyCustomEmailRule(),  
    ],  
]);
```

I think we’re done here. Happy validation and have a good day !
