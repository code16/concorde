@props(['href', 'current' => false])

<a class="group/item relative text-base text-white font-semibold"
    href="{!! e($href, false) !!}"
    @if($current)
        aria-current="page"
    @endif
    {{ $attributes }}
>
    <span class="absolute -inset-2"></span>
    {{ $slot }}
    <span class="absolute left-0 w-full border-b transition border-current opacity-0  -bottom-2 group-hover/item:opacity-50 group-aria-[current=page]/item:opacity-100"></span>
</a>
