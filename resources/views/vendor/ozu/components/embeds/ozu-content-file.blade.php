@php
    /**
     * @var \Code16\OzuClient\Eloquent\Media $media
     */
@endphp

@if(str_starts_with($media->mime_type, 'video/'))
    <div class="my-20">
        <video class="max-w-full max-h-100 lg:max-h-128" autoplay playsinline loop muted>
            <source src="{{ $media->downloadUrl() }}" type="{{ $media->mime_type }}">
        </video>
    </div>
@else
    <p>
        <a href="{{ $media->downloadUrl() }}" download="{{ $name }}" target="_blank">
            {{ $legend ?: $name }}
        </a>
    </p>
@endif

