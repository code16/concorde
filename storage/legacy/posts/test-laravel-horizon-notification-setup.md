---
title: How to test Laravel Horizon notification setup with slack
description: >-
  In Laravel Horizon you can setup a notification system for being alerted when
  there is a too long wait time on your queues (and check if…
date: 2021-11-08
thumbnail: /assets/img/posts/test-laravel-horizon-notification-setup/thumbnail.png
author: arnaud
---

In Laravel Horizon you can setup a [notification system](https://laravel.com/docs/8.x/horizon#notifications) for being alerted when there is a too long wait time on your queues (and check if your queues need more workers). Once everything is setup, you’d generally like to test if everything is wired correctly. Especially with a **slack channel** because it would fail silently if something is missing ([package](https://github.com/laravel/slack-notification-channel)) or wrong (webhook url, slack channel name, etc).

![](/assets/img/posts/test-laravel-horizon-notification-setup/slack.png)

But there is no easy way to trigger manually a Laravel Horizon’s LongWaitDetected notification. Also, maybe you don’t want to make the whole team worry about a false alarm anyway. So here is how you could test the setup from [tinker](https://laravel.com/docs/8.x/artisan#tinker) :

```php
>>> Notification::route('slack', Horizon::$slackWebhookUrl)->notify(new class extends Illuminate\Notifications\Notification  
{  
    public function via($notifiable)  
    {  
        return ['slack'];  
    }

    public function toSlack($notifiable)  
    {  
        return (new Illuminate\Notifications\Messages\SlackMessage)  
                    ->from('Laravel Horizon')  
                    ->to(Laravel\Horizon\Horizon::$slackChannel)  
                    ->error()  
                    ->content(sprintf('[%s] This is a horizon slack notification test.', config('app.name')));  
    }  
});
```

And if everything is right, you should immediately see something like this in the target slack channel:

![](/assets/img/posts/test-laravel-horizon-notification-setup/message.png)

Now you’re sure, the next time one of your queue will be slow or something you’ll get notified properly. Of course it would also work for mail or nexmo.

Have a good day !
