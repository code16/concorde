
<x-layout theme-primary="var(--color-blue-800)">
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
            Praesent quis orci sit amet ante facilisis suscipit. Integer in eros molestie, ultricies arcu ac, cursus quam. Nulla facilisi.
        </x-slot:heading-text>
    </x-hero>
    <div class="mt-12.5 container">
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
            <section class="md:px-12.5 lg:px-17.5">
                <div class="relative">
{{--                    <div class="absolute h-full top-0 -mt-[4.5%] -inset-x-[13%]">--}}
{{--                        <x-icon-browser-frame class="h-auto w-full" />--}}
{{--                    </div>--}}

                    <div class="rounded-2xl bg-white overflow-clip border border-neutral-200">
                        <div class="relative flex py-2.5 px-4 bg-eggplant/5">
                            <div class="flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="14" viewBox="0 0 54 14"><g fill="none" fill-rule="evenodd" transform="translate(1 1)"><circle cx="6" cy="6" r="6" fill="#FF5F56" stroke="#E0443E" stroke-width=".5"></circle><circle cx="26" cy="6" r="6" fill="#FFBD2E" stroke="#DEA123" stroke-width=".5"></circle><circle cx="46" cy="6" r="6" fill="#27C93F" stroke="#1AAB29" stroke-width=".5"></circle></g></svg>
                            </div>
                            <div class="-my-1 w-64 bg-eggplant/5 rounded-md"></div>
                            <div class="flex-1"></div>
                        </div>
                        <div class="p-12">
                            <div class="relative grid grid-cols-1 gap-y-8">
                                @foreach([
                                    'Constat' => 'Les sites web statiques, c’est à dire sans interaction avec les visiteurs (pas de compte, de réservation, de commande...) représentent une large part des sites institutionnels. Ce type d’infrastructure offre des avantages indéniables en matière de performance, de sécurité et de fiabilité.',
                                    'Limites' => 'Cependant, cela présente aussi des limites importantes : mises à jour de contenu complexes, dette technique qui s’accumule, difficultés à faire évoluer le site quand les besoins changent.',
                                    'Solution' => 'Pour conserver les atouts des sites statiques tout en éliminant ces contraintes, Code 16 a développé <strong>Ozu</strong> : une plateforme qui accélère le développement des sites et rend les équipes autonomes dans la gestion de leur contenu, sans compromis sur la performance ni la sécurité.'
                                ]  as $label => $paragraph)
                                    <div class="justify-self-start odd:rounded-tl-md  even:rounded-tr-md even:justify-self-end max-w-180 p-7.5 py-6.5 rounded-2xl
{{--                                        bg-[oklch(from_var(--theme-primary)_.8_c_h_/_.1)]--}}
                                        bg-purple-800/5
                                    ">
                                        <div class="mb-2 -mt-1 text-sm font-bold text-purple-950/50">{{ $label }}</div>
                                        <p class="text-xl/9 font-normal [&_strong]:font-semibold">
                                            {!! $paragraph !!}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                            <div class="self-stretch shrink-0 w-20 min-[23rem]:w-25 md:w-full md:h-30 lg:h-40 bg-purple-50 [&_.accent]:fill-purple-800/50 inset-ring inset-ring-violet-100 rounded-xl">
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
                        La plateforme Ozu comparée à...
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-y-4 gap-x-8 grid-flow-col">
                    <div class="lg:contents *:col-start-1">
                        <h3 class="mb-1 px-1 self-end font-bold text-center">
                            Ozu vs Développement de site dynamique classique
                            (Laravel / Sharp, Wordpress...)
                        </h3>
                        <x-comparison-cell>
                            Développement rapide : quelques jours / semaines vs quelques mois
                        </x-comparison-cell>
                        <x-comparison-cell>
                            Tarif compétitif, à la fois pour le développement et pour la maintenance / hébergement
                        </x-comparison-cell>
                        <x-comparison-cell>
                            Les avantages de l’hébergement statique : performance, fiabilité, sécurité
                        </x-comparison-cell>
                    </div>
                    <div class="lg:contents *:col-start-2">
                        <h3 class="mb-1 px-1 self-end font-bold text-center">
                            Ozu vs Développement purement statique
                        </h3>
                        <x-comparison-cell>
                            Le CMS sur mesure rendant le client final autonome sur le contenu
                        </x-comparison-cell>
                        <x-comparison-cell class="max-lg:col-span-1 col-span-2">
                            Évolutivité : le projet peut évoluer, y compris vers une version dynamique, sans complexité.
                        </x-comparison-cell>
                        <x-comparison-cell>
                            Maintenance technique et fonctionnelle tout au long de la vie du site
                        </x-comparison-cell>
                    </div>
                    <div class="lg:contents *:col-start-3">
                        <h3 class="mb-1 px-1 self-end font-bold text-center">
                            Ozu vs Développement Webflow
                        </h3>
                        <x-comparison-cell>
                            Simplicité d’utilisation
                        </x-comparison-cell>
                        <x-comparison-cell class="lg:hidden">
                            Évolutivité : le projet peut évoluer, y compris vers une version dynamique, sans complexité.
                        </x-comparison-cell>
                        <x-comparison-cell>
                            Souveraineté : développement, infrastructure et hébergement FR
                        </x-comparison-cell>
                    </div>
                </div>
            </section>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:title>
                        Tarification simple
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 gap-y-6">
                    <x-pricing-card>
                        <x-slot:title>
                            Développement et intégration sur mesure, avec l’engagement de qualité Code 16 sur le respect du design, la performance, la prise en compte de l’accessibilité.
                        </x-slot:title>
                        <p>
                            90€HT / heure
                        </p>
                        <p>
                            Site vitrine, de présentation de projets ou d’activité à partir de 3000 €HT
                        </p>
                    </x-pricing-card>
                    <x-pricing-card>
                        <x-slot:title>
                            Hébergement, sauvegardes, maintenance de l’infrastructure, comptes CMS client
                        </x-slot:title>
                        <p>
                            39€HT / mois
                        </p>
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
