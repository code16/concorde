@props([
    'variant' => 'default',
])
<div class="grid place-content-center size-6 transition group-hover/btn:bg-violet-400 group-hover/btn:text-eggplant group-hover/btn:-rotate-45 rounded-full {{
    match($variant) {
        'external' => '-rotate-45 bg-neutral-200 text-eggplant',
        default => 'text-white bg-eggplant',
    }
}}">
    <x-icon-arrow-right class="size-4.5" />
</div>
