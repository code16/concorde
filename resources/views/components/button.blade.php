@props([
    'class' => '',
    'variant' => '',
    'size' => '',
])

<x-button-or-link class="group/btn inline-flex not-[&.static]:relative cursor-pointer items-center font-semibold text-[1rem]/[1.3125rem] transition {{
    match($variant) {
        'link' => 'underline-offset-2 underline decoration-transparent hover:decoration-current/30',
        'link-white' => 'underline-offset-2 text-white underline decoration-current/30 hover:decoration-current/60',
        'white' => 'bg-white text-eggplant hover:bg-violet-900 rounded-full',
        'dark' => 'bg-eggplant text-white hover:bg-violet-900 rounded-full',
        default => '',
    }
}} {{
    !str_starts_with($variant, 'link') ? match($size) {
        'lg' => 'px-8 py-4 gap-3',
        default => 'px-6 py-3 gap-2',
    } : 'gap-2',
}} {{ $class }}"
    :attributes="$attributes"
>
    @if(str_starts_with($variant, 'link'))
        <span class="absolute -inset-2 group-[&.static]/btn:hidden"></span>
    @endif
    {{ $slot }}
</x-button-or-link>
