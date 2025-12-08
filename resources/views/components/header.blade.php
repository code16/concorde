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
        .\@stuck-top\:bg-eggplant {
            @container scroll-state(stuck: top) {
                background-color: var(--color-eggplant);
            }
        }
        .\@stuck-top\:from-eggplant {
            @container scroll-state(stuck: top) {
                --tw-gradient-from: var(--color-eggplant);
            }
        }
        .\@stuck-top\:to-eggplant {
            @container scroll-state(stuck: top) {
                --tw-gradient-to: var(--color-eggplant);
            }
        }
    </style>
@endpushonce

<div class="contents" :data-stuck-top="stuckTop"
    x-data="{ stuckTop: false, isMenuOpen: false, height: 0, top: 0 }"
    x-effect="() => {
        document.documentElement.style.setProperty('--header-height', `${height}px`)
        document.documentElement.style.setProperty('--header-top', `${top}px`)
    }"
    :data-menu-open="isMenuOpen"
>
    <div class="absolute w-full top-3" x-intersect:enter="stuckTop = false" x-intersect:leave="stuckTop = true"></div>
    <div class="absolute inset-0 z-10 pointer-events-none">
        <div class="container sticky @container-scroll -top-6">
            <div class="transition duration-300 {{ match($variant) {
                'dark' => 'bg-[#0B0617]',
                'light' => 'bg-eggplant',
                'theme' => 'bg-transparent in-data-stuck-top:bg-eggplant'
            } }} rounded-2xl h-21.5"></div>
        </div>
    </div>
    <div x-data x-intersect="$dispatch('reset-nav')"></div>

    <header class="container isolate @container-scroll sticky z-20 -top-3"
        x-init="height = $el.offsetHeight; top = $el.getBoundingClientRect().top"
        x-on:scroll.window="top = $el.getBoundingClientRect().top"
        x-resize="height = $height"
    >
        <div class="relative">
            <div class="flex items-center gap-x-6 h-21.5 px-5 pr-7.5 md:pr-5 py-4 md:px-10">
                <div class="flex-1 flex">
                    <a class="relative z-10 block transition duration-300 origin-left lg:@stuck-top:scale-75 lg:in-data-stuck-top:scale-75" href="{{ route('home') }}">
                        <span class="absolute -inset-2"></span>
                        <x-icon-logo class="h-[22px] lg:h-[28px] text-white" />
                    </a>
                </div>
                <div>
                    <button class="grid place-content-center relative z-10 md:hidden" :aria-expanded="isMenuOpen" aria-controls="menu" x-on:click="isMenuOpen = !isMenuOpen" aria-label="Open menu">
                        <span class="absolute -inset-3"></span>
                        <x-icon-close class="hidden in-aria-expanded:block size-6 text-white" />
                        <x-icon-menu class="in-aria-expanded:hidden size-6 text-white" />
                    </button>
                    <div id="menu" class="hidden top-0 inset-x-0 overflow-hidden
{{--                    outline outline-neutral-100 --}}
                    in-data-menu-open:flex flex-col absolute pt-21.5 h-[calc(100dvh-var(--header-top)-.625rem)] bg-eggplant rounded-2xl md:contents">
                        <div class="flex-1 min-h-0  flex flex-col overflow-y-auto md:overflow-visible">
                            <div class="flex-1 flex flex-col md:flex-row md:relative md:pt-0 md:h-auto md:bg-transparent md:max-h-none md:top-0 gap-x-7.5 lg:gap-x-12.5"
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
                                <x-nav-item href="{{ route('articles.index') }}" data-section="blog" :current="request()->routeIs('articles.*')">
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
                            <div class="p-7.5 flex md:hidden">
                                <div class="">
                                    <h2 class="uppercase text-xs text-white opacity-40">
                                        Nous contacter
                                    </h2>
                                    <div class="mt-1.5 md:mt-4.75 text-sm text-white opacity-80">
                                        {{ app(\App\GeneralSettings::class)->contact_email }}
                                    </div>
                                </div>
                                <div class="ml-auto self-end flex gap-5">
                                    <a class="text-white" aria-label="LinkedIn" href="{{ app(\App\GeneralSettings::class)->linkedin_url }}" target="_blank">
                                        <x-icon-linkedin class="size-4" />
                                    </a>
                                    <a class="text-white" aria-label="Github" href="{{ app(\App\GeneralSettings::class)->github_url }}" target="_blank">
                                        <x-icon-github class="size-4" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden md:block flex-1"></div>
            </div>
        </div>
    </header>
</div>
