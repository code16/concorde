---
title: Automatically delete read database notifications in Laravel
description: >-
  When using Laravel, if you need to notify your users you can benefit from its
  built-in notification system. Laravel provides support for…
date: 2022-01-03
thumbnail: /assets/img/posts/automatically-delete-read-database-notifications-in-laravel/thumbnail.jpg
author: arnaud
---

![](/assets/img/posts/automatically-delete-read-database-notifications-in-laravel/thumbnail.jpg)

When using Laravel, if you need to notify your users you can benefit from its built-in notification system. Laravel provides support for sending notifications across a variety of delivery channels, including email and SMS. It is a less-known but you can also stores the notification information in a [database table](https://laravel.com/docs/8.x/notifications#database-notifications).

```
mysql> describe notifications;  
+-----------------+-----------------+------+-----+---------+-------+  
| Field           | Type            | Null | Key | Default | Extra |  
+-----------------+-----------------+------+-----+---------+-------+  
| id              | char(36)        | NO   | PRI | NULL    |       |  
| type            | varchar(255)    | NO   |     | NULL    |       |  
| notifiable_type | varchar(255)    | NO   | MUL | NULL    |       |  
| notifiable_id   | bigint unsigned | NO   |     | NULL    |       |  
| data            | text            | NO   |     | NULL    |       |  
| read_at         | timestamp       | YES  |     | NULL    |       |  
| created_at      | timestamp       | YES  |     | NULL    |       |  
| updated_at      | timestamp       | YES  |     | NULL    |       |  
+-----------------+-----------------+------+-----+---------+-------+  
8 rows in set (0,01 sec)
```

Then you are free to use that information to show those notifications inside your application. It is possible to [customize](https://medium.com/@alouinimedamin/customize-your-database-notification-and-database-channel-in-laravel-576c8fa5f498) the notification format, but by default there is a field dedicated to mark the notification as “read” by the target user.

![](/assets/img/posts/automatically-delete-read-database-notifications-in-laravel/notifications.png)

Be aware that all notifications, even marked as read, will remain in your database forever. Of course you can give your users a way to manually delete notifications through UI, but it can be useful to automatically get rid of those notifications as they generally aren’t useful anymore.

Since July 2021 with Laravel 8.50, you can benefit from [model pruning feature](https://laravel.com/docs/8.x/eloquent#pruning-models). So it is a perfect use case to use it to get rid of old notifications. Unfortunately, Laravel doesn’t provide a built-in model class for our notifications. You will have to create a class matching the existing table “App\Models\Notifications.php” and then add a “prunable” method to clean the stale notification records (older than a week):
 
```php
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Builder;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\MassPrunable;  
  
class Notification extends Model  
{  
    use MassPrunable;  
  
    public function prunable(): Builder  
    {  
        return static::whereNotNull('read_at')  
            ->where('read_at', '<=', now()->subWeek());  
    }  
}
```

Here, we are using the “MassPrunable” trait because we want to improve performance and we have no need to hook an event or something on a single deletion.

Finally if you don’t already prune other models in your application, you’ll have to add this prune task in “Console/Kernel.php” to get things automated:

```php
protected function schedule(Schedule $schedule)  
{  
    $schedule->command('model:prune')->daily();  
}
```

Note that before automate things, you can use “pretend” option with artisan to test how many records will be impacted :

```
> php artisan model:prune --pretend  
1201 [App\Models\Notification] records will be pruned.
```

That’s it for today. Happy pruning y’all !
