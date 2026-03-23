
<x-layout>
    <x-title>
        Notre offre Ozu
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:title>
            Notre offre Ozu
        </x-slot:title>
        <x-slot:heading-text>
            Nous proposons une solution pour développer et mettre en ligne rapidement des sites vitrine de haute qualité qui garantit dans le temps un excellent niveau de performance et de sécurité tout un proposant une gestion de contenu sur mesure.
        </x-slot:heading-text>
    </x-hero>
    <div class="mt-12.5 md:mt-20 container">
        <div class="grid grid-cols-1 gap-y-20 lg:gap-y-30">
{{--            <section class="md:px-12.5 lg:px-17.5">--}}
{{--                <x-section-header>--}}
{{--                    <x-slot:surtitle>--}}
{{--                        Pour qui--}}
{{--                    </x-slot:surtitle>--}}
{{--                    <x-slot:title>--}}
{{--                        Adapté pour les designers<br>et les agences--}}
{{--                    </x-slot:title>--}}
{{--                    <x-slot:heading-text>--}}
{{--                        Proposez à vos clients un site internet développé sur mesure à partir de votre design, avec un système de gestion de contenu.--}}
{{--                    </x-slot:heading-text>--}}
{{--                </x-section-header>--}}
{{--            </section>--}}
            <section class="xl:px-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 rounded-2.5xl pb-7.5 p-2.5 md:p-5 rounded-2xl bg-white inset-ring inset-ring-neutral-200">
                    <div class="grid grid-cols-1 md:grid-rows-[1fr_auto_1fr] px-5 md:px-10 lg:pl-17.5 xl:pl-13.5 lg:pr-22.5">
                        <div class="mb-4 self-end flex items-center gap-0.5">
                            <x-icon-arrow-right-sm class="size-5 text-red-500" />
                            <h2 class="text-sm font-semibold">
                                Pour qui
                            </h2>
                        </div>
                        <p class="max-w-112 font-heading text-2.5xl [&_br]:max-md:hidden lg:text-3xl font-[350]">
                            Proposez à vos clients un site internet développé sur mesure à partir de votre design, avec un système de gestion de contenu.
                        </p>
                    </div>
                    <div class="h-61.5 md:h-80 lg:h-100 grid place-content-center rounded-xl bg-neutral-100 inset-ring inset-ring-neutral-100">
                        {{--                        <x-icon-laravel class="size-full **:origin-center--}}
                        {{--                          [&_[id^='icon-']]:animate-spin [&_[id^='icon']]:[animation-duration:var(--duration)]!--}}
                        {{--                          [&_[id^='icon']]:[transform-box:fill-box]--}}
                        {{--                          [&_[id^='arc-']]:animate-spin [&_[id^='arc-']]:[animation-duration:var(--duration)]!--}}
                        {{--                          [&_#arc-1]:[--duration:150s] [&_#arc-1_[id^='icon']]:[animation-direction:reverse]!--}}
                        {{--                          [&_#arc-2]:[--duration:80s] [&_#arc-2]:[animation-direction:reverse]! [&_#arc-2_[id^='icon']]:[animation-direction:normal]!--}}
                        {{--                          [&_#arc-3]:[--duration:50s] [&_#arc-3_[id^='icon']]:[animation-direction:reverse]!--}}
                        {{--                        " />--}}
                    </div>
                </div>
            </section>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Pourquoi Ozu ?
                    </x-slot:surtitle>
                    <x-slot:title>
                        Tous les avantages <br>d’un hébergement statique
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 auto-rows-fr md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5" >
                    @foreach([
                        'Rapide, stable et sécurisé' => 'Nous concevons chaque projet avec la même rigueur pour livrer en confiance un code propre, maîtrisé et capable d’évoluer.',
                          'Gestion de contenu sur mesure' => 'Nous gardons la main sur l’ensemble des briques, du développement au déploiement, pour être autonome et réactifs.',
                        'Maintenance technique complète' => 'Nous assurons la maintenance technique de nos réalisations et les faisons évoluer au rythme des besoins.',

                    ] as $title => $description)
                        <article class="group/item flex flex-row md:flex-col gap-x-1 min-[23rem]:gap-x-3.75 md:gap-6.25 lg:gap-8.75 p-2 rounded-2xl  bg-white inset-ring inset-ring-neutral-200">
                            <div class="self-stretch shrink-0 w-20 min-[23rem]:w-25 md:w-full md:h-30 lg:h-40 bg-blue-50 [&_.accent]:fill-blue-300 inset-ring inset-ring-violet-100 rounded-xl">
                                @if($loop->index === 0)
                                    <x-icon-approach-demanding class="max-md:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#diamond]:-translate-y-[5%]" />
                                    <x-icon-approach-demanding-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 1)
                                    <x-icon-approach-autonomous class="max-md:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#pastille]:translate-x-[5%]" />
                                    <x-icon-approach-autonomous-mobile class="md:hidden size-full" />
                                @elseif($loop->index === 2)
                                    <x-icon-approach-maintenance class="max-md:hidden size-full **:transition **:duration-300 group-hover/item:[&_#wrench]:-translate-y-[5%]" />
                                    <x-icon-approach-maintenance-mobile class="md:hidden size-full" />
                                @endif
                            </div>
                            <div class="md:self-stretch p-2.5 md:pt-0 md:p-5 lg:pt-0 lg:p-7">
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
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:title>
                        Nos sites Ozu
                    </x-slot:title>
                </x-section-header>
                <x-project-grid class="mt-7.5 md:mt-10 min-h-120 content-start">
                    @foreach(\App\Models\Project::take(4)->get() as $project)
                        <x-project-item :project="$project" />
                    @endforeach
                </x-project-grid>
            </section>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:title>
                        Tarifs
                    </x-slot:title>
                </x-section-header>
            </section>
        </div>
    </div>
</x-layout>
