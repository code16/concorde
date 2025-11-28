@props(['home' => false, 'variant'])


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
        <div class=" {{ match($variant) { 'dark' => 'bg-[#0B0617]', 'light' => 'bg-eggplant' } }} rounded-2xl h-21.5"></div>
    </div>
</div>
<div x-data x-intersect="$dispatch('reset-nav')"></div>

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
            <div class="flex-1 flex">
                <a class="relative block transition duration-300 origin-left lg:@stuck-top:scale-75" href="{{ route('home') }}">
                    <span class="absolute -inset-2"></span>
                    <x-icon-logo class="h-[22px] lg:h-[28px] text-white" />
                </a>
            </div>
            <div>
                <div class="hidden md:flex relative gap-7.5 lg:gap-x-12.5"
                    @if($home)
                        x-data="{ current: -1, rect: null, rects: [], sections: [] }"
                        x-init="sections = [...$el.querySelectorAll('a')].map(a => {
                            const section = document.querySelector(`#${a.getAttribute('data-section')}`);
                            new IntersectionObserver(entries => {
                                if(entries[0].isIntersecting) {
                                    current = sections.indexOf(section);
                                }
                            }, { rootMargin: '-50% 0px' }).observe(section);
                            return section;
                        })"
                        x-on:reset-nav.document="current = -1"
                        x-resize="
                            rect = $el.getBoundingClientRect();
                            rects = [...$el.querySelectorAll('a')].map(el => el.getBoundingClientRect())
                        "
                    @endif
                >
                    <x-nav-item href="{{ route('projects.index') }}" data-section="projects" :current="request()->routeIs('projects.*')">
                        Nos projets
                    </x-nav-item>
                    <x-nav-item href="{{ route('home').'#approach' }}" data-section="approach">
                        Notre approche
                    </x-nav-item>
                    <x-nav-item href="{{ route('home').'#team' }}" data-section="team">
                        L’équipe
                    </x-nav-item>
                    <x-nav-item href="{{ route('articles.index') }}" data-section="blog" :current="request()->routeIs('article.*')">
                        Blog
                    </x-nav-item>
                    @if($home)
                        <div class="hidden md:block absolute -bottom-2 left-0 w-full origin-left translate-x-(--left,0) scale-x-(--width,0) ease-in-out transition-all will-change-transform duration-500 size-px bg-white"
                            x-show="rect"
                            :style="rect && current >= 0 ? {
                                '--left': `${(rects[current].left - rect.left) / rect.width * 100}%`,
                                '--width': `${(rects[current].width / rect.width) * 100}%`
                            } : null"
                        ></div>
                    @endif
                </div>
            </div>

            <div class="hidden md:block flex-1"></div>
        </div>
    </div>
</header>
