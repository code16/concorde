@props(['class' =>'', 'variant' => ''])

<a class="inline-flex group/btn gap-2 items-center font-semibold text-[.9375rem]/[1.3125rem] transition {{
    match($variant) {
        'link' => 'underline-offset-2 underline decoration-transparent hover:decoration-current/30'
    }
}} {{ $class }}" {{ $attributes }}>
    {{ $slot }}
</a>
