@props([
    'url',
    'legend' => null,
])

<div class="mb-14 md:mb-18 -mx-7.5 md:mx-0">
    <figure class="md:rounded-2xl md:p-2 md:bg-neutral-50 md:border border-neutral-200">
        <x-embed-video class="w-full aspect-16/9 md:rounded-xl border border-neutral-200" :url="$url" />
        @if($legend)
            <figcaption class="min-w-0 text-sm text-neutral-600 mt-3 mb-2 px-7.5 md:px-4">
                {{ $legend }}
            </figcaption>
        @endif
    </figure>
</div>
