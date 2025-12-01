@props([
    'author' => null,
])
<figure>
    <blockquote style="padding-left: 1rem; border-left: 3px solid #ccc">
        {{ $slot }}
    </blockquote>

    @if($author)
        <figcaption>
            {{ $author }}
        </figcaption>
    @endif
</figure>

