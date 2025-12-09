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
    <body class="bg-neutral-100 text-eggplant font-sans font-medium antialiased bg-stone-50 text-base {{ $attributes->get('class') }}">
        <div class="relative flex flex-col py-2.5 min-h-screen">
            @if($home ?? false)
                <div class="mb-2 hidden min-[23rem]:block relative z-20 container">
                    <div class="flex gap-6 py-1.25 px-5 md:px-10 rounded-2xl bg-violet-400">
                        <p class="text-xs/5.5 font-semibold">
                            <span class="md:hidden">
                                Nos outils sur-mesure
                            </span>
                            <span class="max-md:hidden">
                                Nos outils sur-mesure pour structurer et accélérer vos projets Laravel
                            </span>
                        </p>
                        <div class="ml-auto flex gap-5">
                            @foreach(\App\Models\Tool::all() as $tool)
                                <a class="flex gap-0.5 items-start font-semibold text-xs/5.5" href="{{ $tool->website_url }}">
                                    {{ $tool->title }}
                                    <x-icon-arrow-up-right class="size-4 mt-1" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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
