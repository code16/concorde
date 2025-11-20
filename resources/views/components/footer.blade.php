
<footer>
    <x-container class="border-y">
        <div class="flex flex-col md:flex-row">
            <div class="flex-1 border-b flex items-center justify-center px-6 py-4.25 text-center md:text-right md:border-0 md:justify-end">
                <div class="text-body-t2">
                    To reach us, only one channel:
                    <a class="font-medium underline underline-offset-2 not-hover:decoration-1" href="https://www.linkedin.com/company/structure-brand-design-transformation-growth/" target="_blank">
                        LinkedIn
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap justify-center items-center md:border-l border-neutral-900 px-6 py-5 gap-6">
                @foreach ([
                    'Home' => route('home'),
                    'Work' => route('projects.index'),
                    'Views' => route('articles.index'),
                    ...\App\Models\Page::whereIn('key', ['legals'])->get()->mapWithKeys(fn ($page) => [
                        $page->title => route('pages.show', $page)
                    ]),
                ] as $label => $url)
                    <a href="{{ $url }}" class="relative block text-body-t4 underline-offset-2 hover:underline">
                        <span class="absolute -inset-x-2 -inset-y-3"></span>
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </x-container>
    <div class="container xl:border-x px-16 py-20 md:px-20 md:py-30 lg:py-[10.625rem] border-neutral-900" x-data="{ distance: 400 }"
        x-on:mousemove="rect = $refs.zone.getBoundingClientRect();
        const distance = Math.sqrt((Math.abs($event.screenX - (rect.left + rect.width/2)) * .4) ** 2 + Math.abs($event.screenY - (rect.top + rect.height * 1.5)) ** 2);
        $refs.base.style.opacity = Math.max(0, Math.min(distance / 300, 1))"
        x-on:mouseleave=" $refs.base.style.opacity = 1"
    >
        <div class="group relative grid grid-cols-1 grid-rows-1 w-[46.5rem] max-w-full mx-auto">
            <x-icon-logo class="w-full row-start-1 col-start-1 text-stone-300 " />
            <x-icon-logo class="w-full row-start-1 col-start-1 will-change-[opacity]" x-ref="base" />
            <x-icon-logo-hover class="w-full relative row-start-1 col-start-1 opacity-100 transition" />
            <div class="absolute left-[10%] top-0 h-full w-[20%]" x-ref="zone"></div>
        </div>
    </div>
</footer>
