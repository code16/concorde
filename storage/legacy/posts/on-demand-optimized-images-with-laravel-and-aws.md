---
title: On-demand optimized images with Laravel and AWS
description: >-
  Setting up your own image transform service on AWS to serve properly sized and
  optimized assets with Laravel
date: 2021-05-01
thumbnail: /assets/img/posts/on-demand-optimized-images-with-laravel-and-aws/thumbnail.jpg
author: arnaud
---

Most of modern websites have image-rich designs but handle images inefficiently. Here are some of the common mistakes when serving hosted images on an average Laravel app:

*   unnecessarily large pixels size (especially on mobile)
*   unnecessary high quality
*   not optimized formats and retention of metadata
*   bad cache policy (often as [nginx’s default behaviour](https://smknstd.medium.com/how-http-cache-on-static-assets-works-out-of-the-box-db11f02bb2c6))

Image size is a big contributor to page load speed, which in turn is a key metric in determining search result rankings. Reducing image size can go a long way toward improving your spot in search engines as google or bing. But it can also help with the perception of website speed by your customers, and it can make a huge difference on conversion rate and stickiness.

On top of that, file uploads are costly. Even if all the images already ends on cloud storage like s3 thanks to the [flysystem](https://github.com/thephpleague/flysystem) library, they necessarily transit through the website and are temporally stored on local storage. And it costs to the server some resources and bandwidth.

At [code16](https://code16.fr/en/), we maintain an e-commerce platform with some large catalog (~60000 product images), and we’d like to solve both of these problems:

*   serve [optimized images](https://web.dev/fast/#i18n.paths.fast.topics.optimize_your_images)
*   make admin life easier with file uploads

## Resizing at upload time vs on-demand

Of course it is perfectly possible to handle image trans­formations and optimizations on our server with a resizing strategy at _upload time_. But it requires to know in advance which dimensions are necessary. If later you require a new size, you will need to regenerate all the files again. Also even if there are convenient ways to [optimize files in php](https://github.com/spatie/image-optimizer), it could be a proces­sor inten­sive task, especially if you doesn’t prevent your users to upload large files.

Fortunately we live in a modern world and online ser­vices like [Imgix](https://www.imgix.com/) and [Cloud­i­nary](https://cloudinary.com/) are available to offload the work to their scal­able servers. Instead of optimize files at upload, they let you do that _on-demand_. You will request your images from a special URL including parameters like size and it will generates the new image and serve it in really little time (a few milliseconds). All those ser­vices are probably excel­lent, but they could be pricey and they didn’t fit our budget so we looked for something else.

## AWS to the rescue

As our image assets are already stored on s3, it feels natural to look what similar solutions exist on AWS itself. We found out we can easily deploy our [own setup](https://github.com/awslabs/serverless-image-handler) to dynamically handle images on the fly, out of the box. And it comes with many pros:

*   can be plugged to our existing s3 bucket
*   can be deployed with a point & click _no-code_ [Cloud­For­ma­tion](https://aws.amazon.com/cloudformation/) template
*   promise to be very cheap

The solution also comes with cons:

*   limited configuration (CORS policy, 404, etc)
*   setup can’t always be updated after creation, it could need a rebuild (with a different cloudfront url)

Now visitors instead of requesting images directly from our php server will be served directly by amazon’s CDN. They will get optimized images properly sized and served with an aggressive cache policy. From a Laravel point of view, all we need to do is to get the proper urls in our blade templates.

Here is how the custom url pointing to cloudfront is generated:

```php 
function squareThumbnailUrl(Product $product, int $width = 400)  
{  
    return sprintf(  
        "%s/fit-in/%sx%s/filters:fill(ffffff)/products/%s/%s",  
        config("services.cloudfront.url"),  
        $width,  
        $width,  
        $product->reference,  
        $product->visual_filename  
    );  
}
```

## No more file uploads

To avoid file upload to our php backend, we ask website administrators to use a desktop application to directly update files on s3 bucket: [Cyberduck](https://cyberduck.io/). It is [opensource](https://github.com/iterate-ch/cyberduck) and available on both windows and mac.

But now, our app would need to check what’s on s3 every time someone wants to display a product thumbnail. It would be an unacceptable bottleneck and point of failure. So we absolutely need to keep information on visual files up to date in our application database.

S3 provides various types of event notifications whenever an operation has been done on an object. Wiring those notifications to [AWS Simple Notification Service](https://en.wikipedia.org/wiki/Amazon_Simple_Notification_Service) will let us trigger events on an external https webhook. This way AWS will notify our Laravel app about every S3 object operations. Here is the setup:

*   A Laravel endpoint listening to AWS events (thanks to this great [library](https://github.com/renoki-co/laravel-sns-events))
*   An SNS topic with a “subscription” to target the Laravel endpoint
*   Setup the SNS topic as a destination for S3 notifications on the source bucket

Now our Laravel app receives events from AWS but the only available piece of information available for each file is the path (as a string). So we’ll need some tricks to extract product identifier from this string to finally update the right product in our database. Of course, it also needs to do so accordingly to event type: add, rename, delete.

Here is the basic idea of our listener:

```php 
public function handle($event)  
{  
    $content = json_decode($event->payload['message']['Message'], true);  
      
    foreach ($content["Records"] ?? [] as $record) {

        // path of the file in s3 bucket as a string  
        dd($record["s3"]["object"]["key"]); //"products/123/front.jpg"  
              
        switch ($record["eventName"]) {  
            case "ObjectCreated:Copy":  
            case "ObjectCreated:Put":  
            case "ObjectCreated:Post":  
                //a new visual has been added  
                break;  
            case "ObjectRemoved:Delete":  
                //a visual has been deleted  
                break;  
        }  
    }  
}
```

## New architecture

We’re done ! As the final setup isn’t obvious, I tried to make an overview with all features. It is far from perfect but here it is and I sincerely hope it will help someone getting optimized images on his website. Happy coding y’all !

![](/assets/img/posts/on-demand-optimized-images-with-laravel-and-aws/graph.png)
