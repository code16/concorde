<?php

return [
    // List here your collections, ie the Models that will be handled by the Ozu CMS.
    // You must also properly configure them (see documentation).
    'collections' => [
        \App\Models\Testimonial::class,
        \App\Models\Project::class,
        \App\Models\Article::class,
        //        \App\Models\Project::class,
    ],

    // The Ozu unique key of the website to use
    'website_key' => env('OZU_WEBSITE_KEY'),

    // The API key to use to authenticate with the Ozu API
    // (do not fill this value here, use the .env file instead)
    'api_key' => env('OZU_API_KEY'),

    // The following values should not be modified unless you know what you are doing
    'api_host' => env('OZU_API_HOST', 'https://ozu.code16.fr/'),
    'api_version' => env('OZU_API_VERSION', 'v1'),

    'cdn_url' => env('OZU_CDN_URL'),
];
