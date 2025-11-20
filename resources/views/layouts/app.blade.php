<!DOCTYPE html>
<html class="not-has-[header:focus-within]:scroll-pt-(--header-height)"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php($title = (isset($title) ? "$title — "  : '') . 'Code 16')
        @php($metaDescription = $metaDescription->attributes['content'] ?? '')
        @php($metaImage = $metaImage->attributes['content'] ?? asset('/img/og-image.png'))
        @php($metaType ??= 'website')

        @if(str(request()->route()->uri())->contains('{page?}'))
            <link rel="canonical" href="{{ route(request()->route()->getName(), absolute: false) }}">
        @endif

        <title>{{ $title }}</title>

        <meta name="description" content="{{ $metaDescription }}">

        <meta property="og:title" content="{{ $title }}">
        <meta property="og:type" content="{{ $metaType }}" />
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Code 16">
        <meta property="og:image" content="{{ $metaImage }}">
        <meta property="twitter:card" content="summary_large_image">

        <link rel="icon" href="/favicon.ico" sizes="48x48">
        <link rel="icon" href="/favicons/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">

        <link rel="preload" href="{{ Vite::asset('resources/fonts/manrope-variable.woff2') }}" as="font" type="font/woff2" crossorigin>

        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
        ])
        <style>
            [x-cloak] { display: none!important; }
        </style>
        {{ $head ?? null }}
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-stone-50 text-body-16 {{ $attributes->get('class') }}">
        <div class="relative flex flex-col min-h-screen">
            <x-header />

            <main id="content" class="flex-1 flex flex-col">
                {{ $slot }}
                <x-container class="flex-1"></x-container>
            </main>

            <x-footer />
        </div>

        @stack('script')
    </body>
</html>
