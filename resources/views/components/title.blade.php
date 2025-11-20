
<x-slot:title>
    {!! str(html_entity_decode($slot, ENT_QUOTES))->replace('<br>', ' ')->squish()->stripTags()->trim() !!}
</x-slot:title>
