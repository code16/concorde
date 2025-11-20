@props([
    'content'
])

@if($content)
    <x-slot:meta-image :content="$content"></x-slot:meta-image>
@endif
