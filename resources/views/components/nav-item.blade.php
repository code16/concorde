@props(['href', 'current' => false])

<a class="group/item flex items-center gap-5 px-7.5 py-5 md:p-0 relative text-base text-white font-semibold"
    href="{!! e($href, false) !!}"
    @if($current)
        aria-current="page"
    @endif
    {{ $attributes }}
>
    <span class="absolute hidden md:block -inset-2"></span>
    {{ $slot }}
    <x-icon-arrow-right class="ml-auto text-white size-5 md:hidden" />
    <span class="absolute left-0 w-full border-b bottom-0 transition border-[#31254C] md:border-current md:opacity-0 md:-bottom-2 group-hover/item:border-white md:group-hover/item:opacity-50 md:group-aria-[current=page]/item:opacity-100"></span>
</a>
