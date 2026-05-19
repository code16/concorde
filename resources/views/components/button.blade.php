@props([
    'class' => '',
    'variant' => '',
    'size' => '',
])

<a class="group/btn inline-flex not-[&.static]:relative gap-2 cursor-pointer items-center font-semibold text-[1rem]/[1.3125rem] transition {{
    match($variant) {
        'link' => 'underline-offset-2 underline decoration-transparent hover:decoration-current/30',
        'white' => 'bg-white text-eggplant hover:bg-violet-400 rounded-full',
        default => '',
    }
}} {{
    $variant !== 'link' ? match($size) {
        'lg' => 'px-8 py-4',
        default => 'px-6 py-3',
    } : '',
}} {{ $class }}" {{ $attributes }}>
    <span class="absolute -inset-2 group-[&.static]/btn:hidden"></span>
    {{ $slot }}
</a>
