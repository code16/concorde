@props(['project' => null])

@php
/**
 * @var \Code16\OzuClient\Eloquent\Media $media
 */
@endphp


<div class="mb-14 md:mb-18 -mx-7.5 md:mx-0 flex flex-col items-center">
    <figure class="md:rounded-2xl md:p-2 md:bg-neutral-50 md:border border-neutral-200"
        x-data="{ imgWidth: 0 }"
        :style="{ '--img-width': `${imgWidth}px` }"
    >
        @if($thumbnail = $media->thumbnail(1400, 1024))
            <img class="min-h-50 max-w-full object-cover max-h-100 lg:max-h-128 border-y md:border-x md:rounded-xl overflow-hidden border-neutral-200"
                width="{{ $thumbnail->width() }}"
                height="{{ $thumbnail->height() }}"
                src="{{ $thumbnail }}"
                alt="{{ $legend ?? '' }}"
                loading="lazy"
                x-init="imgWidth = $el.offsetWidth"
                x-resize="imgWidth = $width"
            >
        @endif
        @if($legend)
            <figcaption class="min-w-0 max-w-(--img-width) text-sm text-neutral-600 mt-3 mb-2 px-7.5 md:px-4">
                {{ $legend }}
            </figcaption>
        @endif
    </figure>
</div>

