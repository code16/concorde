
<x-layout theme-primary="var(--color-blue-800)">
    <x-title>
        Notre offre Ozu
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:surtitle>
            Ozu
        </x-slot:surtitle>
        <x-slot:title>
            Chez Code 16, <br>nous traitons les petits projets comme les grands
        </x-slot:title>
    </x-hero>
    <div class="mt-12.5 container">
        <div class="mb-15">
            <div class="aspect-16/9 rounded-2xl overflow-clip bg-eggplant" x-data="{ playing: false, }">
                <div class="relative size-full flex flex-col justify-center items-center isolate" x-on:click="playing = true" x-show="!playing">
                    <div class="absolute h-auto -z-10 left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 size-[70%]">
                        <x-icon-ozu class="text-violet-400/20" />
                    </div>
                    <button class="flex items-center font-bold text-eggplant p-4 gap-4 cursor-pointer rounded-full bg-white hover:bg-violet-400 transition" aria-label="Lancer la vidéo">
                        <x-icon-play class="size-10" />
                        <span class="pr-4">
                            Ozu en une minute
                        </span>
                    </button>
                </div>
                <template x-if="playing">
                    <div class="size-full *:size-full">
                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/ENozagjU-TI?si=mbp3r38E73w1aFEN&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </template>
            </div>
        </div>
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
{{--            <section class="">--}}

{{--            </section>--}}
{{--            <section class="xl:px-3">--}}
{{--                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 rounded-2.5xl pb-7.5 p-2.5 md:p-5 rounded-2xl bg-white inset-ring inset-ring-neutral-200">--}}
{{--                    <div class="grid grid-cols-1 md:grid-rows-[1fr_auto_1fr] px-5 md:px-10 lg:pl-17.5 xl:pl-13.5 lg:pr-22.5">--}}
{{--                        <div class="mb-4 self-end flex items-center gap-0.5">--}}
{{--                            <x-icon-arrow-right-sm class="size-5 text-red-500" />--}}
{{--                            <h2 class="text-sm font-semibold">--}}
{{--                                Pour qui--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <p class="max-w-112 font-heading text-2.5xl [&_br]:max-md:hidden lg:text-3xl font-[350]">--}}
{{--                            Proposez à vos clients un site internet développé sur mesure à partir de votre design, avec un système de gestion de contenu.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="h-61.5 md:h-80 lg:h-100 grid place-content-center rounded-xl bg-neutral-100 inset-ring inset-ring-neutral-100">--}}
{{--                        --}}{{--                        <x-icon-laravel class="size-full **:origin-center--}}
{{--                        --}}{{--                          [&_[id^='icon-']]:animate-spin [&_[id^='icon']]:[animation-duration:var(--duration)]!--}}
{{--                        --}}{{--                          [&_[id^='icon']]:[transform-box:fill-box]--}}
{{--                        --}}{{--                          [&_[id^='arc-']]:animate-spin [&_[id^='arc-']]:[animation-duration:var(--duration)]!--}}
{{--                        --}}{{--                          [&_#arc-1]:[--duration:150s] [&_#arc-1_[id^='icon']]:[animation-direction:reverse]!--}}
{{--                        --}}{{--                          [&_#arc-2]:[--duration:80s] [&_#arc-2]:[animation-direction:reverse]! [&_#arc-2_[id^='icon']]:[animation-direction:normal]!--}}
{{--                        --}}{{--                          [&_#arc-3]:[--duration:50s] [&_#arc-3_[id^='icon']]:[animation-direction:reverse]!--}}
{{--                        --}}{{--                        " />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
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
                            <div class="self-stretch shrink-0 w-20 min-[23rem]:w-25 md:w-full md:h-30 lg:h-40 bg-purple-50 [&_.accent]:fill-violet-400 inset-ring inset-ring-violet-100 rounded-xl">
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
{{--            <section class="md:px-12.5 lg:px-17.5">--}}
{{--                <x-section-header>--}}
{{--                    <x-slot:title>--}}
{{--                        La plateforme Ozu comparée à...--}}
{{--                    </x-slot:title>--}}
{{--                </x-section-header>--}}
{{--                <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-y-4 gap-x-8 grid-flow-col">--}}
{{--                    <div class="lg:contents *:col-start-1">--}}
{{--                        <h3 class="mb-1 px-1 self-end font-bold text-center">--}}
{{--                            Ozu vs Développement de site dynamique classique--}}
{{--                            (Laravel / Sharp, Wordpress...)--}}
{{--                        </h3>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Développement rapide : quelques jours / semaines vs quelques mois--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Tarif compétitif, à la fois pour le développement et pour la maintenance / hébergement--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Les avantages de l’hébergement statique : performance, fiabilité, sécurité--}}
{{--                        </x-comparison-cell>--}}
{{--                    </div>--}}
{{--                    <div class="lg:contents *:col-start-2">--}}
{{--                        <h3 class="mb-1 px-1 self-end font-bold text-center">--}}
{{--                            Ozu vs Développement purement statique--}}
{{--                        </h3>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Le CMS sur mesure rendant le client final autonome sur le contenu--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell class="max-lg:col-span-1 col-span-2">--}}
{{--                            Évolutivité : le projet peut évoluer, y compris vers une version dynamique, sans complexité.--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Maintenance technique et fonctionnelle tout au long de la vie du site--}}
{{--                        </x-comparison-cell>--}}
{{--                    </div>--}}
{{--                    <div class="lg:contents *:col-start-3">--}}
{{--                        <h3 class="mb-1 px-1 self-end font-bold text-center">--}}
{{--                            Ozu vs Développement Webflow--}}
{{--                        </h3>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Simplicité d’utilisation--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell class="lg:hidden">--}}
{{--                            Évolutivité : le projet peut évoluer, y compris vers une version dynamique, sans complexité.--}}
{{--                        </x-comparison-cell>--}}
{{--                        <x-comparison-cell>--}}
{{--                            Souveraineté : développement, infrastructure et hébergement FR--}}
{{--                        </x-comparison-cell>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:title>
                        Tarification simple
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-[1fr_1px_1fr] rounded-2xl bg-white inset-ring inset-ring-neutral-200">
                    <x-pricing-card>
                        <x-slot:title>
                            Développement
                        </x-slot:title>
                        <p>
                            Développement et intégration sur mesure, avec l’engagement de qualité Code 16 sur le respect du design, la performance, la prise en compte de l’accessibilité.
                        </p>
                        <x-slot:price>
                            <p>
                                <span class="text-3xl font-light font-heading">90€</span> <span class="text-sm">HT / heure</span>
                            </p>
                        </x-slot:price>
                    </x-pricing-card>
                    <div class="border-l border-dashed border-l-neutral-200"></div>
                    <x-pricing-card>
                        <x-slot:title>
                            Maintenance
                        </x-slot:title>
                        <p>
                            Hébergement, sauvegardes, maintenance de l’infrastructure, comptes CMS client
                        </p>
                        <x-slot:price>
                            <p>
                                <span class="text-3xl font-light font-heading">39€</span> <span class="text-sm">HT / mois</span>
                            </p>
{{--                        <p>--}}
{{--                            Site vitrine, de présentation de projets ou d’activité à partir de 3000€ HT--}}
{{--                        </p>--}}
                        </x-slot:price>
                    </x-pricing-card>
                </div>
            </section>
            @if(count($projects = \App\Models\Project::where('is_ozu', true)->get()) > 0)
                <section class="md:px-12.5 lg:px-17.5">
                    <x-section-header>
                        <x-slot:title>
                            Nos sites Ozu
                        </x-slot:title>
                    </x-section-header>
                    <x-project-grid class="mt-7.5 md:mt-10 min-h-120 content-start">
                        @foreach($projects as $project)
                            <x-project-item :project="$project" />
                        @endforeach
                    </x-project-grid>
                </section>
            @endif
        </div>
    </div>
</x-layout>
