@props([
    'class' => '',
    'variant' => 'default',
])

<div class="grid place-content-center size-6 transition group-hover/btn:bg-violet-400 group-hover/btn:text-eggplant rounded-full {{
    match($variant) {
        'external' => '-rotate-45 bg-neutral-200 text-eggplant group-hover/btn:-rotate-45',
        'back' => '-rotate-180 text-white bg-eggplant group-hover/btn:-rotate-135',
        'dark' => 'bg-white text-eggplant group-hover/btn:-rotate-45',
        default => 'text-white bg-eggplant group-hover/btn:-rotate-45',
    }
}} {{ $class }}">
    <x-icon-arrow-right class="size-4.5" />
</div>
