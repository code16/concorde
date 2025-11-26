

<x-layout>
    <x-slot:header>
        <x-header home />
    </x-slot:header>
    <div class="container">
        <div class="rounded-2xl bg-[#0B0617]">
            <div class="relative isolate overflow-clip rounded-b-2xl min-h-[540px] bg-[linear-gradient(180deg,#0A0515,#1C0F36)] px-7.5 md:px-12.5 lg:px-17.5 py-25 md:pt-32.5 md:pb-42.5">
                <x-icon-bg-grid class="absolute  -z-10 -top-4 -right-103.5 md:-right-40.5 lg:-right-21.5 w-190" />
                <div class="max-w-110 md:max-w-142 lg:max-w-172">
                    <p class="mb-2.5 font-medium text-violet-400 text-base">
                        Artisans du web
                    </p>
                    <h1 class="font-heading font-[450] text-4xl md:text-5xl lg:text-6xl text-heading text-white">
                        Nous développons des projets web faits pour durer.
                    </h1>
                    <p class="mt-3.75 text-base font-medium text-neutral-250">
                        Depuis 2007, nous concevons et maintenons avec exigence des projets web ou mobiles, en étroite collaboration avec nos clients.
                    </p>
                    <div class="mt-5 flex flex-col md:flex-row flex-wrap gap-y-1.25 gap-x-5">
                        @foreach([
                            'Experts Laravel',
                            'Développement sur-mesure',
                            'Technologies open source',
                        ] as $label)
                            <div class="flex items-center gap-1.5">
                                <x-icon-circle-check class="size-4.5 fill-violet-400 text-eggplant" />
                                <div class="font-semibold text-base text-white">
                                    {{ $label }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-12.5 space-y-12.5 md:space-y-20 lg:space-y-30 md:mt-20">
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Projets
                    </x-slot:surtitle>
                    <x-slot:title>
                        Découvrez nos projets à la une,
                        <br>reflet de la diversité de nos missions.
                    </x-slot:title>
                    <x-slot:actions>
                        <x-button href="{{ route('projects.index') }}" variant="link" cta>
                            Explorer nos projets
                        </x-button>
                    </x-slot:actions>
                </x-section-header>
                <div class="mt-7.5 grid grid-cols-1 md:grid-cols-2 gap-2.5 md:gap-3.75 lg:gap-5">
                    @foreach($projects as $project)
                       <x-project-item :project="$project" />
                    @endforeach
                </div>
            </section>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header vertical>
                    <x-slot:surtitle>
                        Notre approche
                    </x-slot:surtitle>
                    <x-slot:title>
                        Là où nous faisons la différence.
                    </x-slot:title>
                    <x-slot:heading-text>
                        Nous construisons des projets solides et évolutifs, avec une exigence constante sur la qualité.
                    </x-slot:heading-text>
                </x-section-header>
                <div class="mt-10 grid md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5">
                    @foreach([
                        'Exigence' => 'Nous concevons chaque projet avec la même rigueur pour livrer avec ocnfiance un code propre, maîtrisé et capable d’évoluer.',
                        'Suivi' => 'Nous assurons la maintenance technique de nos réalisations et les faisons évoluer au rythme des besoins.',
                        'Autonomie' => 'Nous gardons la main sur l’ensemble des briques, du développement au déploiement, pour être autonome et réactifs.',
                    ] as $title => $description)
                        <article class="group/item flex flex-row md:flex-col gap-3.75 md:gap-6.25 lg:gap-8.75 p-2 rounded-2xl bg-white inset-ring inset-ring-neutral-200">
                            <div class="shrink-0 w-25 md:w-full md:h-30 lg:h-40 bg-violet-50 inset-ring inset-ring-violet-100 rounded-xl">
                                @if($loop->index === 0)
                                    <x-icon-approach-demanding class="max-md:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#diamond]:-translate-y-[5%]" />
                                    <x-icon-approach-demanding-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 1)
                                    <x-icon-approach-maintenance class="max-md:hidden size-full **:transition **:duration-300 group-hover/item:[&_#wrench]:-translate-y-[5%]" />
                                    <x-icon-approach-maintenance-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 2)
                                    <x-icon-approach-autonomous class="max-md:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#pastille]:translate-x-[5%]" />
                                    <x-icon-approach-autonomous-mobile class="md:hidden size-full" />
                                @endif
                            </div>
                            <div class="p-2.5 md:pt-0 md:p-5 lg:pt-0 lg:p-7">
                                <h3 class="text-2xl font-heading font-[450]">
                                    {{ $title }}
                                </h3>
                                <p class="mt-1.25 text-base text-neutral-600">
                                    {{ $description }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
            <section class="xl:px-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 rounded-2.5xl pb-7.5 p-2.5 md:p-5 rounded-2xl bg-white inset-ring inset-ring-neutral-200">
                    <div class="h-61.5 md:h-80 lg:h-100 grid place-content-center rounded-xl bg-neutral-100 inset-ring inset-ring-neutral-100">
                        <x-icon-laravel class="size-full **:origin-center
                          [&_[id^='icon-']]:animate-spin [&_[id^='icon']]:[animation-duration:var(--duration)]!
                          [&_[id^='icon']]:[transform-box:fill-box]
                          [&_[id^='arc-']]:animate-spin [&_[id^='arc-']]:[animation-duration:var(--duration)]!
                          [&_#arc-1]:[--duration:150s] [&_#arc-1_[id^='icon']]:[animation-direction:reverse]!
                          [&_#arc-2]:[--duration:80s] [&_#arc-2]:[animation-direction:reverse]! [&_#arc-2_[id^='icon']]:[animation-direction:normal]!
                          [&_#arc-3]:[--duration:50s] [&_#arc-3_[id^='icon']]:[animation-direction:reverse]!
                        " />
                    </div>
                    <div class="grid grid-cols-1 md:grid-rows-[1fr_auto_1fr] px-5 md:px-10 lg:pl-17.5 xl:pl-22.5 lg:pr-17.5">
                        <div class="mb-4 self-end flex items-center gap-0.5">
                            <x-icon-arrow-right-sm class="size-5 text-red-500" />
                            <h2 class="text-sm font-semibold">
                                Technologie
                            </h2>
                        </div>
                        <p class="max-w-112 font-heading text-2.5xl [&_br]:max-md:hidden lg:text-3xl font-[350]">
                            Nous sommes spécialistes de Laravel, dont l’écosystème auquel nous participons nous offre des solutions variées qui nous permettent de répondre à tous types de projets.
                        </p>
                    </div>
                </div>
            </section>
            <section class="md:px-7.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Frameworks
                    </x-slot:surtitle>
                    <x-slot:title class="max-w-127">
                        <span class="lg:hidden">
                            Des outils conçus pour accélérer vos projets.
                        </span>
                        <span class="max-lg:hidden">
                            Des outils conçus pour accélérer et optimiser vos projets.
                        </span>
                    </x-slot:title>
                    <x-slot:heading-text>
                        Nous avons développé deux outils pour enrichir l’écosystème Laravel et offrir aux développeurs des bases solides pour leurs applications.
                    </x-slot:heading-text>
                </x-section-header>
                <div class="mt-7.5 md:mt-10 grid grid-cols-1 md:grid-cols-2 gap-y-3.5 gap-x-5">
                    {{-- Tool is a Sushi model, edit values in model class --}}
                    @foreach(\App\Models\Tool::all() as $tool)
                        <article class="relative rounded-2xl border border-neutral-200 transition bg-neutral-100 hover:bg-eggplant">
                            <div class="-m-px grid grid-cols-[auto_minmax(0,1fr)] gap-x-3.75 lg:gap-x-7.5 px-7.5 py-6.25 md:py-7.5 lg:py-10 rounded-2xl bg-white border border-neutral-200">
                                <img class="lg:row-span-2 size-10 md:size-15 object-cover rounded-lg lg:rounded-xl lg:w-26.5 lg:h-25.5" src="{{ $tool->logo }}" alt="{{ $tool->title }}">
                                <div class="flex items-center gap-1.75 lg:gap-2.5">
                                    <h3 class="text-2.5xl md:text-3xl font-heading font-[450]">
                                        {{ $tool->title }}
                                    </h3>
                                    @if($tool->is_open_source)
                                        <div class="shrink-0 rounded-lg text-[.875rem]/[1.375rem] font-semibold bg-neutral-100 py-0.5 px-2.5 lg:py-1.25 text-neutral-600">
                                            Open source
                                        </div>
                                    @endif
                                </div>
                                @if($tool->item_text)
                                    <p class="mt-2 col-span-full lg:col-span-1 text-base font-medium">
                                        {!! $tool->item_text !!}
                                    </p>
                                @endif
                            </div>
                            <div class="py-2.5 lg:py-3.75 px-5">
                                <a class="group/btn font-semibold transition text-eggplant hover:text-white text-base flex items-center justify-between gap-4" href="{{ $tool->website_url }}">
                                    <span class="absolute rounded-[1.25rem] inset-0"></span>
                                    Explorer {{ $tool->title }}
                                    <x-button-arrow />
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <div class="pt-32"></div>


{{--    <img class="container" src="/screen.png">--}}
</x-layout>
