---
title: How to get notified when Laravel Horizon stops running
description: >-
  Learn how to setup a scheduled task to check periodically for Laravel
  Horizon’s status and notify your team as soon as it doesn’t work
date: 2021-11-11
thumbnail: /assets/img/posts/how-to-get-notified-when-laravel-horizon-stops-running/thumbnail.png
author: arnaud
---

If you need to manage queues in Laravel you probably use [Horizon](https://laravel.com/docs/8.x/horizon). Setting it up is pretty straightforward and once installed [with a daemon](https://medium.com/@taylorotwell/deploying-horizon-to-laravel-forge-fc9e01b74d84) you generally don’t have to care too much. Also Horizon ships with a dashboard UI where you can check what’s going on your queues and in particular the current status of the queues processing.

#### Shit happens

For some reasons, someday, the process fails and the daemon can’t restart. So Horizon stops running jobs. The problem is that you won’t be notified in such a case. Generally you won’t notice those missing async job executions quickly as no error is raised anywhere. Of course when users start contacting your support to report that they don’t get emails, you’ll visit the Horizon dashboard and will see that red cross. Too bad ! You probably shouldn’t rely on your users to monitor Horizon :)

![](/assets/img/posts/how-to-get-notified-when-laravel-horizon-stops-running/horizon.png)

Ideally when Horizon status change, you’ll get a nice notification, unfortunately there is no way to do that out of the box. Horizon have a built-in [notification system](https://laravel.com/docs/8.x/horizon#notifications) but as far as I know it only notifies you when things get slow on your queues.

There is also an artisan command, that gives you the same status shown in dashboard, directly in the cli. But it won’t help you to automate things as it has no specific exit status, it just prints a human readable status and always returns 0 :

```
> php artisan horizon:status  
Horizon is inactive.
```

#### Periodically check with a schedule task

So here’s a simple solution you could use based on a scheduled task that will check Horizon status every five minutes. If it is inactive, it will do something (send an email or ping your team on a specific slack channel).

```php
namespace App\Console;  
  
use Illuminate\Console\Scheduling\Schedule;  
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;  
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class Kernel extends ConsoleKernel  
{  
    protected function isHorizonActive() : bool  
    {  
        if (! $masters = app(MasterSupervisorRepository::class)->all()) {  
            return false;  
        }  
  
        return collect($masters)->some(function ($master) {  
            return $master->status !== 'paused';  
        });  
    }  
  
    protected function schedule(Schedule $schedule)  
    {  
        $schedule  
            ->call(function () {  
                if (!$this->isHorizonActive()) {  
                    // notify your team  
                }  
            })  
            ->everyFiveMinutes();  
    }
}
```


As long as horizon is inactive, you will keep receiving notifications every five minutes so it is not perfect.

#### Cron monitoring

In addition, to make things easier, you could use a cron monitoring solution. There are plenty out there but my favorite is [healthcheck](https://healthchecks.io/), which is completely [open source](https://github.com/healthchecks/healthchecks). It handles team [notifications](https://healthchecks.io/docs/configuring_notifications/) and has a great [failure feature](https://healthchecks.io/docs/signaling_failures/) that we can benefit from. Every time Horizon is active we will ping healtcheck. And when Horizon is inactive, it is transmitted as a failure to healthcheck so it will raise a notification immediately. Then for every new failure, it won’t do anything until it goes back to normal.

Here’s how you could wire things together :

```php
protected function schedule(Schedule $schedule)  
{  
    $schedule  
        ->call(function () {  
             file_get_contents('https://hc-ping.com/your-uuid-here' . ($this->isHorizonActive() ? '' : '/fail'));  
        })  
        ->everyFiveMinutes();  
}
```

Now when horizon stops running, you’ll get notified properly in the next 5 minutes. Plus the whole team will know when things get back to normal. Hopefully, you’ll be able to fix things up before a user notice any problem. Much better, right ?
