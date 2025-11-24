

<x-layout>
    <x-slot:header>
        <x-header home />
    </x-slot:header>
    <div class="container">
        <div class="rounded-2xl bg-[#0B0617]">
            <div class="relative isolate overflow-clip rounded-b-2xl min-h-[540px] bg-[linear-gradient(180deg,#0A0515,#1C0F36)] px-7.5 md:px-12.5 lg:px-17.5 py-25 md:pt-32.5 md:pb-42.5">
                <x-icon-bg-grid class="absolute  -z-10 -top-4 -right-103.5 md:-right-40.5 -right-21.5 w-190" />
                <div class="max-w-110 md:max-w-142 lg:max-w-172">
                    <p class="mb-2.5 font-medium text-violet-400 text-base">
                        Artisans du web
                    </p>
                    <h1 class="font-heading font-[450] text-4xl md:text-5xl lg:text-6xl text-heading text-white">
                        Nous développons des projets web fais pour durer.
                    </h1>
                    <p class="mt-3.75 text-base font-medium text-neutral-250">
                        Depuis 2007, nous concevons et maintenons avec rigueur et exigeance des projets web et mobiles, en étroite collaboration avec nos clients.
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
        <div class="mt-12.5 space-y-12.5 md:space-y-12.5 md:mt-20">
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
                        'Exigeance' => 'Nous concevons chaque projet avec rigueur, pour livrer un code propre, maîtrisé, et capable d’évoluer.',
                        'Suivi' => 'Nous assurons la maintenance de nos réalisations  et les faisons évoluer au rythme des besoins.',
                        'Autonomie' => 'Nous gardons la main sur l’ensemble du cycle de production pour être toujours autonome et réactifs. ',
                    ] as $title => $description)
                        <article class="flex flex-row md:flex-col gap-3.75 md:gap-6.25 lg:gap-8.75 p-2 rounded-2xl bg-white inset-ring inset-ring-neutral-200">
                            <div class="shrink-0 w-25 md:w-full md:h-30 lg:h-40 bg-violet-50 inset-ring inset-ring-violet-100 rounded-xl">
                                @if($loop->index === 0)
                                    <x-icon-approach-demanding class="max-md:hidden size-full [&_#diamond]:transition hover:[&_#diamond]:-translate-y-[10%]" />
                                    <x-icon-approach-demanding-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 1)
                                    <x-icon-approach-maintenance class="max-md:hidden size-full" />
                                    <x-icon-approach-maintenance-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 2)
                                    <x-icon-approach-autonomous class="max-md:hidden size-full" />
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
        </div>
    </div>

    <div class="pt-32"></div>

{{--    <x-icon-laravel class="size-100 **:origin-center--}}
{{--      [&_[id^='icon-']]:animate-spin [&_[id^='icon']]:[animation-direction:reverse]! [&_[id^='icon']]:[animation-duration:var(--duration)]!--}}
{{--      [&_[id^='icon']]:[transform-box:fill-box]--}}
{{--      [&_[id^='arc-']]:animate-spin [&_[id^='arc-']]:[animation-duration:var(--duration)]--}}
{{--      [&_#arc-1]:[--duration:40s]--}}
{{--      [&_#arc-2]:[--duration:25s]--}}
{{--      [&_#arc-3]:[--duration:15s]--}}
{{--    " />--}}
{{--    <img class="container" src="/screen.png">--}}
</x-layout>
