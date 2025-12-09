@props([
    /** @var \App\Models\Article $article */
    'article',
    'home' => false,
    'horizontal' => false,
])

<article class="relative flex  gap-y-3 gap-x-6 {{ $horizontal ? 'flex-row md:flex-row py-6 md:px-0' /*  md:px-4md:bg-white md:border md:border-neutral-200 md:rounded-2xl*/ : 'flex-col' }}">
    <a href="{{ $article->url() }}" tabindex="-1">
        <img class="{{ $horizontal ? 'hidden md:block md:w-48 aspect-1/1' : 'aspect-16/9 w-full' }} object-cover rounded-xl border border-neutral-200" src="{{ $article->cover?->thumbnail(1024) ?: asset('/img/placeholder.svg') }}" alt="{{ $article->title }}">
    </a>
    <div class="flex-1 {{-- p-2.5 --}}">
        <div class="flex gap-4">
            <div class="text-sm font-semibold text-neutral-500">{{ $article->category_label ?: 'Article' }}</div>
            <div class="{{ $horizontal ? 'ml-0' : 'ml-auto' }} text-sm font-semibold text-neutral-500">
                {{ $article->publication_date->isoFormat('L') }}
            </div>
        </div>
        <h3 class="mt-3 {{ $horizontal ? 'text-2.5xl  md:text-3xl' : 'text-2xl' }} max-w-150 font-heading font-[450]">
            <a class="hover:underline" href="{{ $article->url() }}">
                {{ $article->title }}
            </a>
        </h3>
        @if($horizontal && $article->item_text)
            <p class="mt-3 md:mt-4 text-sm md:text-base max-w-[65ch] text-neutral-600">
                {!! $article->item_text !!}
            </p>
        @endif
        @if($home)
            <div class="mt-3">
                <x-button href="{{ $article->url() }}" class="w-full" variant="link" tabindex="-1">
                    <span class="absolute inset-0"></span>
                    Lire l’article
                    <x-icon-arrow-right class="ml-auto size-4.5"/>
                </x-button>
            </div>
        @endif
    </div>
</article>
