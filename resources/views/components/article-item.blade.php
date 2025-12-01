@props([
    /** @var \App\Models\Article $article */
    'article',
    'home' => false,
])

<article class="relative">
    <img class="w-full object-cover rounded-xl border border-neutral-200 aspect-16/9" src="{{ $article->cover?->thumbnail(1024) ?: asset('/img/placeholder.svg') }}" alt="{{ $article->title }}">
    <div class="mt-3">
        <div class="flex gap-4">
            <div class="text-sm font-semibold text-neutral-500">{{ $article->category_label ?: 'Blog' }}</div>
            <div class="ml-auto text-sm font-semibold text-neutral-500">
                {{ $article->publication_date->isoFormat('L') }}
            </div>
        </div>
        <h3 class="mt-3 text-2xl font-heading font-[450]">
            <a class="hover:underline" href="{{ $article->url() }}" @if($home) tabindex="-1" @endif>
                @if(!$home)
                    <span class="absolute inset-0"></span>
                @endif
                {{ $article->title }}
            </a>
        </h3>
        @if($home)
            <div class="mt-3">
                <x-button href="{{ $article->url() }}" class="w-full" variant="link">
                    <span class="absolute inset-0"></span>
                    Lire l’article
                    <x-icon-arrow-right class="ml-auto size-4.5"/>
                </x-button>
            </div>
        @endif
    </div>
</article>
