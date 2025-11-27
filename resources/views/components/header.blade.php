@props(['home' => false])


@pushonce('head')
    <style>
        .lg\:\@stuck-top\:scale-75 {
            @container scroll-state(stuck: top) {
                @media (min-width: 768px) {
                    scale: .75;
                }
            }
        }
    </style>
@endpushonce


<div class="absolute inset-0 z-10 pointer-events-none">
    <div class="container sticky -top-6">
        <div class="bg-[#0B0617] rounded-2xl h-21.5"></div>
    </div>
</div>

<header class="container isolate @container-scroll sticky z-20
-top-3
{{-- top-2.5--}}
">
{{--    <div class="bg-neutral-100 absolute -z-10 -top-2.5 w-full h-6"></div>--}}
    <div class="relative">
{{--        <div class="absolute -z-10 inset-0 @stuck-top:bottom-4 rounded-2xl bg-eggplant"></div>--}}
        <div class="flex items-center gap-x-6
{{--    bg-[#0B0617]/70--}}
{{--    backdrop-blur-lg--}}
{{--     backdrop-brightness-60--}}
{{--     backdrop-contrast-140--}}
{{--backdrop-saturate-300--}}
{{--backdrop-invert-100--}}
     h-21.5 px-5 py-4 md:px-10">
            <div class="flex-1">
                <div class="relative">
                    <x-icon-logo class="h-[22px] lg:h-[28px] lg:@stuck-top:scale-75 origin-left
                     text-white
{{--                    @stuck-top:opacity-0--}}
                     transition duration-300" />
{{--                    <x-icon-logo-small class="absolute top-0 left-0 h-[28px] text-white  transition duration-300" />--}}
                </div>
            </div>
            <div>
                <div class="hidden md:flex relative gap-7.5 lg:gap-x-12.5"
                    x-data="{ current: -1, rect: null, rects: [] }"
                    x-on:scroll.window="current = Math.min(3, Math.floor(window.scrollY / 500))"
                    x-resize="
                        rect = $el.getBoundingClientRect();
                        rects = [...$el.children].map(el => el.getBoundingClientRect())
                    "
                >
                    @foreach([
                        'Nos projets' => '#projects',
                        'Notre approche' => '#approach',
                        'L’équipe' => '#team',
                        'Blog' => '#blog',
                    ] as $label => $url)
                        <a class="relative text-base font-semibold text-white hover:underline" href="{{ $label }}">
                            <span class="absolute -inset-2"></span>
                            {{ $label }}
                        </a>
                    @endforeach
                    <div class="hidden md:block absolute -bottom-2 left-0 translate-x-(--left) scale-x-(--width) ease-in-out transition-all will-change-transform duration-500 size-px bg-white"
                        x-show="rect"
                        :style="rect && current >= 0 ? {
                        '--left': `${rects[current].left + rects[current].width / 2 - rect.left}px`,
                        '--width': `${rects[current].width}`
                    } : null"
                    ></div>
                </div>
            </div>

            <div class="hidden md:block flex-1"></div>
        </div>
    </div>
</header>

@if($home)
    <div class="container">
        <div class="bg-[#0B0617] h-4 -mt-4"></div>
    </div>
@endif
