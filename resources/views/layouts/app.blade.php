<!DOCTYPE html>
<html class="not-has-[header:focus-within]:scroll-pt-32 scroll-smooth"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php($title = isset($title->attributes['full']) ? $title : (isset($title) ? "$title — "  : '') . 'Code 16')
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
        <link rel="icon" href="/favicons/favicon.svg" type="image/svg+xml" media="(prefers-color-scheme: dark)">
        <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">
        <link rel="manifest" href="/site.webmanifest" />

        <link rel="preload" href="{{ Vite::asset('resources/fonts/Manrope-variable.woff2') }}" as="font" type="font/woff2" crossorigin>

        @env('production')
            <script src="https://cdn.usefathom.com/script.js" data-site="UYEFQCWU" defer></script>
        @endenv

        {{ $headStart ?? null }}
        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
        ])
        <style>
            [x-cloak] { display: none!important; }
        </style>
        @if($themePrimary)
            <style>
                :root {
                    --theme-primary: {{ $themePrimary }};
                    --theme-accent: {{ $themeAccent }};
                }
            </style>
        @endif
        {{ $head ?? null }}
        @stack('head')
    </head>
    <body class="bg-neutral-100 text-eggplant font-sans antialiased bg-stone-50 text-base {{ $attributes->get('class') }}">
        <div class="relative flex flex-col py-2.5 min-h-screen">
            <div class="flex-1 relative flex flex-col">
                @if($header ?? null)
                    {{ $header }}
                @else
                    <x-header />
                @endif

                <main id="content" class="flex-1 flex flex-col">
                    {{ $slot }}
                </main>

                <x-footer />
            </div>
        </div>

        @stack('script')
    </body>
</html>
