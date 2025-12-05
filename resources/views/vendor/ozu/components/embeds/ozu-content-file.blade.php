@php
    /**
     * @var \Code16\OzuClient\Eloquent\Media $media
     */
@endphp

@if(str_starts_with($media->mime_type, 'video/'))
    <div class="mb-14 md:mb-18 -mx-7.5 md:mx-0 flex flex-col items-center">
        <figure class="md:rounded-2xl md:p-2 md:bg-neutral-50 md:border border-neutral-200"
            x-data="{ imgWidth: 0 }" :style="{ '--img-width': `${imgWidth}px` }">
            <video class="max-w-full object-cover max-h-100 lg:max-h-128 border md:rounded-xl overflow-hidden border-neutral-200" playsinline loop muted controls x-init="imgWidth = $width" x-resize="imgWidth = $width">
                <source src="{{ $media->downloadUrl() }}" type="{{ $media->mime_type }}">
            </video>
            @if($legend)
                <figcaption class="min-w-0 max-w-(--img-width) text-sm text-neutral-600 mt-3 mb-2 px-7.5 md:px-4">
                    {{ $legend }}
                </figcaption>
            @endif
        </figure>
    </div>
@else
    <p>
        <a href="{{ $media->downloadUrl() }}" download="{{ $name }}" target="_blank">
            {{ $legend ?: $name }}
        </a>
    </p>
@endif

