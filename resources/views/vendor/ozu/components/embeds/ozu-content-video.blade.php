@props([
    'url',
    'legend' => null,
])
<figure>
    <x-embed-video :url="$url" />

    @if($legend)
        <figcaption>
            {{ $legend }}
        </figcaption>
    @endif
</figure>
