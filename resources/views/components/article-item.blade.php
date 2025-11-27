@props([/** @var \App\Models\Article $article */'article'])

<article class="relative">
    <img class="w-full object-cover rounded-xl border border-neutral-200 aspect-16/9" src="{{ $article->cover?->thumbnail(1024) ?: asset('/img/placeholder.svg') }}" alt="{{ $article->title }}">
    <div class="mt-4">
        <div class="flex gap-4">
            @if($article->category_label)
                <div class="text-sm font-semibold text-neutral-500">{{ $article->category_label }}</div>
            @endif
            <div class="ml-auto text-sm font-semibold text-neutral-500">
                {{ $article->publication_date->isoFormat('L') }}
            </div>
        </div>
        <h3 class="mt-2 text-xl font-heading font-[450]">
            {{ $article->title }}
        </h3>
        <div class="mt-2">
            <x-button href="{{ $article->url() }}" class="w-full" variant="link">
                <span class="absolute inset-0"></span>
                Lire l’article <x-icon-arrow-right class="ml-auto size-4.5" />
            </x-button>
        </div>
    </div>
</article>
