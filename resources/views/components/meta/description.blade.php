@props([
    'content'
])

@php($content = str(html_entity_decode($content, ENT_QUOTES))->replace('<br>', ' ')->squish()->stripTags()->trim()->limit(300))

<x-slot:meta-description :content="$content">
</x-slot:meta-description>
