@php
    /**
     * @var \Code16\OzuClient\Eloquent\Media $media
     */
@endphp

<p>
    <a href="{{ $media->downloadUrl() }}" download="{{ $name }}" target="_blank">
        {{ $legend ?? $name }}
    </a>
</p>
