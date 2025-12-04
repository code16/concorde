@props(['class' =>'', 'variant' => ''])

<a class="group/btn inline-flex not-[&.static]:relative gap-2 items-center font-semibold text-[1rem]/[1.3125rem] transition {{
    match($variant) {
        'link' => 'underline-offset-2 underline decoration-transparent hover:decoration-current/30'
    }
}} {{ $class }}" {{ $attributes }}>
    <span class="absolute -inset-2 group-[&.static]/btn:hidden"></span>
    {{ $slot }}
</a>
