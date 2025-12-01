@props(['project' => null])

@php
/**
 * @var \Code16\OzuClient\Eloquent\Media $media
 */
@endphp

<figure class="{{ $project ? '-mx-[calc((100cqw-65ch)/2)]' : '' }} border border-neutral-100">
    <img class="w-full" src="{{ $media->thumbnail($project ? 2048 : 1400) }}" alt="{{ $legend ?? '' }}">
    @if($legend)
        <figcaption>
            {{ $legend }}
        </figcaption>
    @endif
</figure>
