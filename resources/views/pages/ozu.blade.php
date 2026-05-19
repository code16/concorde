
<x-layout theme-primary="var(--color-blue-800)">
    <x-title>
        Ozu, traiter les petits projets comme les grands
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:title>
            Grâce à Ozu,<br>nous traitons les petits projets comme les grands
        </x-slot:title>
        <div class="mt-6">
            <x-button href="mailto:contact@code16.fr" variant="link-white">
                <x-button-arrow variant="dark" />
{{--                <x-icon-arrow-right class="-ml-1 size-5" />--}}
                Parlons de votre projet
            </x-button>
        </div>
        <div class="h-16 md:h-40"></div>
    </x-hero>
    <div class="container relative">
        <div class="-mt-16 md:-mt-52 md:px-12.5 lg:px-17.5 mb-20 lg:mb-30">
            <div class="aspect-16/9 overflow-clip bg-eggplant shadow-xl" x-data="{ playing: false, }">
                <div class="group relative isolate size-full flex flex-col justify-center items-center bg-white" x-on:click="playing = true; $refs.video.play()" x-show="!playing">
                    <x-icon-ozu class="absolute -z-10 size-[55%] text-violet-200 group-hover:scale-110 transition duration-300" />
                    <x-button size="lg" variant="dark" aria-label="Lancer la vidéo">
                        <span class="absolute inset-0"></span>
                        <x-icon-play class="-ml-3 size-8" />
                        Découvrir Ozu en une minute
                    </x-button>
                </div>
                <video class="size-full" x-show="playing" controls x-ref="video" preload="none" x-cloak>
                    <source src="https://do3eutfoa8i0h.cloudfront.net/ozu-presentation.mp4" type="video/mp4">
                </video>
{{--                <template x-if="playing">--}}
{{--                    <div class="size-full *:size-full">--}}
{{--                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/ENozagjU-TI?si=mbp3r38E73w1aFEN&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>--}}
{{--                    </div>--}}
{{--                </template>--}}
            </div>
        </div>
        <div class="grid grid-cols-1 gap-y-20 lg:gap-y-30">
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Pourquoi Ozu ?
                    </x-slot:surtitle>
                    <x-slot:title>
                        Les avantages d’un hébergement statique,<br>sans les inconvénients
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 auto-rows-fr md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5" >
                    @foreach([
                        'Rapide, stable et sécurisé' => 'Un site statique est fait de fichiers pré-calculés, le rendant très performant et le mettant à l’abri de la grande majorité des attaques.',
                        'Gestion de contenu sur mesure' => 'Vos clients peuvent gérer leur contenu en autonomie avec un dashboard moderne et pensé pour être simple d’utilisation.',
                        'Maintenance technique complète' => 'Nous appliquons même garantie de maintenance que sur les gros projets, assurant continuité de service et évolutivité.',
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
            <div class="grid grid-cols-1 gap-y-10">
                <section class="md:px-12.5 lg:px-17.5">
                    <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200">
                        <div class="grid grid-cols-1 md:grid-cols-5">
                            <div class="md:order-1 md:col-span-2 min-h-48 bg-purple-50 relative overflow-hidden flex items-center justify-center">
                                <x-icon-ozu-tailor-made class="w-full" />
                                {{--                                <div class="absolute inset-6 rounded-3xl border-[1.5px] border-violet-200/70"></div>--}}
                                {{--                                <div class="absolute inset-12 rounded-2xl border-[1.5px] border-violet-300/70"></div>--}}
                                {{--                                <div class="absolute inset-[4.5rem] rounded-xl border-[1.5px] border-violet-400/70"></div>--}}
                                {{--                                <x-icon-ozu class="relative size-20 text-violet-400/25" />--}}
                            </div>
                            <div class="md:col-span-3 p-7 lg:p-12 flex flex-col justify-center gap-5">
                                <div class="flex items-center gap-0.5">
                                    <x-icon-arrow-right-sm class="size-5 text-violet-400" />
                                    <span class="text-sm font-semibold">Sur-mesure</span>
                                </div>
                                <h3 class="font-heading text-2.5xl lg:text-3xl font-[350]">
                                    Votre design, <br>intégralement respecté
                                </h3>
                                <p class="text-neutral-600 max-w-prose">
                                    Ozu ne repose sur aucun thème, aucun constructeur de pages, aucun template : nous intégrons votre design pixel par pixel, avec une liberté totale sur les animations, les interactions et la mise en page. Le résultat final correspond exactement à ce qui a été conçu.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="md:px-12.5 lg:px-17.5">
                    <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200">
                        <div class="grid grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-2 min-h-48 bg-blue-50 relative overflow-hidden flex items-center justify-center">
                                <svg viewBox="-64 -64 128 128" class="size-32" aria-hidden="true">
                                    <circle cx="0" cy="-56" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="28" cy="-48.4974" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="48.4974" cy="-28" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="56" cy="0" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="48.4974" cy="28" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="28" cy="48.4974" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="0" cy="56" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="-28" cy="48.4974" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="-48.4974" cy="28" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="-56" cy="0" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="-48.4974" cy="-28" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="-28" cy="-48.4974" r="5" fill="#facc15" fill-opacity="0.8" />
                                    <circle cx="0" cy="0" r="24" fill="#1d4ed8" fill-opacity="0.1" stroke="#1d4ed8" stroke-opacity="0.2" stroke-width="2" />
                                </svg>
{{--                                @foreach(range(0, 11) as $i)--}}
{{--                                    <div class="absolute size-2.5 rounded-full bg-yellow-400/80"--}}
{{--                                        style="transform: rotate({{ $i * 30 }}deg) translateY(-56px)"></div>--}}
{{--                                @endforeach--}}
{{--                                <div class="relative size-12 rounded-full bg-blue-700/10 ring-2 ring-blue-700/20"></div>--}}
                            </div>
                            <div class="md:col-span-3 p-7 lg:p-12 flex flex-col justify-center gap-5">
                                <div class="flex items-center gap-0.5">
                                    <x-icon-arrow-right-sm class="size-5 text-violet-400" />
                                    <span class="text-sm font-semibold">Souveraineté</span>
                                </div>
                                <h3 class="font-heading text-2.5xl lg:text-3xl font-[350]">
                                    Ozu est 100% européen
                                </h3>
                                <p class="text-neutral-600 max-w-prose">
                                    L’infrastructure d’Ozu ne dépend pas de fournisseurs hors Union Européenne&nbsp;: le CMS, les données, le site, les sauvegardes et les services automatisés de suivi de production et de remontée des anomalies sont tous assurés par des prestataires européens et localisés en Europe.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Comparer
                    </x-slot:surtitle>
                    <x-slot:title>
                        En quoi Ozu est-il différent<br>d’autres solutions ?
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <x-comparison-card>
                        <x-slot:title>
                            WordPress
                        </x-slot:title>
                        <ul class="space-y-4">
                            @foreach([
                                'Performances bien supérieures grâce à l’hébergement statique',
                                'Sécurité renforcée : aucune base de données exposée, aucun plugin vulnérable',
                                'Aucune mise à jour WordPress ou d’extensions à gérer',
                                'Design 100% sur mesure, sans thèmes ni page builders',
                                'Coût total maîtrisé sur la durée',
                            ] as $point)
                                <li class="flex gap-3 items-start">
                                    <x-icon-circle-check class="size-5 fill-violet-600 text-purple-50 shrink-0 mt-0.5" />
                                    <span class="text-neutral-600 text-base">{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-comparison-card>
                    <x-comparison-card>
                        <x-slot:title>
                            Webflow
                        </x-slot:title>
                        <ul class="space-y-4">
                            @foreach([
                                'Liberté de design absolue, sans les contraintes de l’éditeur visuel',
                                'Hébergement et données en France, sans dépendance à un SaaS américain',
                                'Évolutivité totale : le projet peut évoluer vers des fonctionnalités dynamiques avancées',
                                'CMS configuré précisément selon les besoins de chaque client',
                            ] as $point)
                                <li class="flex gap-3 items-start">
                                    <x-icon-circle-check class="size-5 fill-violet-600 text-purple-50 shrink-0 mt-0.5" />
                                    <span class="text-neutral-600 text-base">{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-comparison-card>
                </div>
            </section>

            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Cas d’utilisation
                    </x-slot:surtitle>
                    <x-slot:title>
                        De nombreux types de projets<br>sont parfaitement adaptés à Ozu
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <article class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
                        <div class="h-36 bg-violet-50 p-4 flex flex-col gap-2">
                            <div class="h-3.5 rounded-sm w-full border border-violet-300 bg-violet-100"></div>
                            <div class="flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="flex gap-2">
                                <div class="h-5 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="h-5 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="h-5 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-heading font-[450]">Site vitrine et marketing</h3>
                            <p class="mt-1 text-sm text-neutral-600">Présentation d'une activité, de services ou d'une entreprise avec un design soigné pour convaincre.</p>
                        </div>
                    </article>
                    <article class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
                        <div class="h-36 bg-violet-50 flex flex-col items-center justify-center gap-2.5 p-6">
                            <div class="w-3/4 h-5 rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="w-1/2 h-3 rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="mt-1 w-28 h-7 rounded-full border border-violet-300 bg-violet-100"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-heading font-[450]">Landing page produit</h3>
                            <p class="mt-1 text-sm text-neutral-600">Mise en avant d’un produit ou d’une offre, optimisée pour capter l'attention et convertir.</p>
                        </div>
                    </article>
                    <article class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
                        <div class="h-36 bg-violet-50 p-4 grid grid-cols-2 gap-2">
                            <div class="rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="rounded-sm border border-violet-300 bg-violet-100"></div>
                            <div class="rounded-sm border border-violet-300 bg-violet-100"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-heading font-[450]">Portfolio de projets</h3>
                            <p class="mt-1 text-sm text-neutral-600">Valorisation de réalisations ou d’un portfolio créatif dans une mise en page personnalisée.</p>
                        </div>
                    </article>
                    <article class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
                        <div class="h-36 bg-violet-50 p-4 flex flex-col gap-2">
                            <div class="flex-1 rounded-sm flex flex-col justify-center gap-2 px-3 border border-violet-300">
                                <div class="h-3 w-4/5 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="h-2 w-3/5 rounded-sm border border-violet-300 bg-violet-100"></div>
                            </div>
                            <div class="flex gap-1.5">
                                <div class="flex-1 h-7 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="w-20 h-7 rounded-full border border-violet-300 bg-violet-100"></div>
                            </div>
{{--                            <div class="flex gap-3">--}}
{{--                                <div class="h-2 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>--}}
{{--                                <div class="h-2 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>--}}
{{--                                <div class="h-2 flex-1 rounded-sm border border-violet-300 bg-violet-100"></div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-heading font-[450]">Site de génération de lead</h3>
                            <p class="mt-1 text-sm text-neutral-600">Site de captation de contacts qualifiés grâce à des appels à l'action ciblés.</p>
                        </div>
                    </article>
                    <article class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
                        <div class="h-36 bg-violet-50 flex overflow-hidden">
                            <div class="w-20 shrink-0 flex flex-col items-center justify-center gap-2 py-4 border-r border-violet-300 bg-violet-100">
                                <div class="h-2 w-10 rounded-full border border-violet-300 bg-violet-50"></div>
                                <div class="h-8 w-12 rounded-md border border-violet-300 bg-violet-50"></div>
                                <div class="h-2 w-8 rounded-full border border-violet-300 bg-violet-50"></div>
                            </div>
                            <div class="flex-1 p-4 flex flex-col justify-center gap-2.5">
                                <div class="h-3 w-5/6 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="h-2.5 w-2/3 rounded-sm border border-violet-300 bg-violet-100"></div>
                                <div class="mt-1 flex gap-2">
                                    <div class="h-4 w-14 rounded-full border border-violet-300 bg-violet-100"></div>
                                    <div class="h-4 w-10 rounded-full border border-violet-300 bg-violet-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-heading font-[450]">Site événementiel</h3>
                            <p class="mt-1 text-sm text-neutral-600">Programmation, agenda, lien billetterie : un site à l'image de l'événement, conçu pour mobiliser le public.</p>
                        </div>
                    </article>
                    <div class="rounded-2xl bg-neutral-50 p-1.5 border border-neutral-200 flex flex-col">
                        <div class="flex-1 rounded-xl border border-neutral-200 bg-white flex flex-col p-6 gap-6 justify-center">
                            <p class="text-neutral-600">
                                Votre projet implique un compte client, des prises de commande ou un catalogue dynamique ? Ozu ne sera pas adapté, mais Code 16 si&nbsp;!
                            </p>
                        </div>
                        <div class="p-4">
                            <x-button href="{{ route('projects.index') }}" variant="link" class="text-sm">
                                <x-button-arrow />
                                Voir nos références de sites dynamiques
                            </x-button>
                        </div>
                    </div>
                </div>
            </section>
            <div class="rounded-3xl bg-eggplant text-white pt-12">
                <section class="px-5 md:px-12.5 lg:px-17.5">
                    <x-section-header>
                        <x-slot:surtitle>
                            Tarification simple
                        </x-slot:surtitle>
                        <x-slot:title>
                            Des délais réduits,<br>et une facture plus légère
                        </x-slot:title>
                    </x-section-header>
                    <p class="mt-7 text-white/50 max-w-2xl">
                        Ozu est également une plateforme technique proposant un outillage complet qui permet à Code 16 de réduire le temps de développement,
                        et donc le montant global des projets. À titre d'exemple, le budget pour un site vitrine complet de présentation de projets
                        ou d'activité démarre à 3&nbsp;000&nbsp;€&nbsp;HT.
                    </p>
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-[1fr_1px_1fr] rounded-2xl bg-white/10 inset-ring inset-ring-white/20">
                        <x-pricing-card>
                            <x-slot:title>
                                Développement
                            </x-slot:title>
                            <p>
                                Développement et intégration sur mesure, avec l’engagement de qualité Code 16 sur le respect du design, la performance, la prise en compte de l'accessibilité.
                            </p>
                            <x-slot:price>
                                <p>
                                    <span class="text-3xl font-light font-heading">650€</span> <span class="text-sm">HT / jour</span>
                                </p>
                            </x-slot:price>
                        </x-pricing-card>
                        <div class="border-t md:border-l border-dashed border-white/20"></div>
                        <x-pricing-card>
                            <x-slot:title>
                                Maintenance
                            </x-slot:title>
                            <p>
                                Hébergement, sauvegardes quotidiennes, maintenance de l’infrastructure, maintenance et suivi du projet, comptes CMS client.
                            </p>
                            <x-slot:price>
                                <p>
                                    <span class="text-3xl font-light font-heading">39€</span> <span class="text-sm">HT / mois</span>
                                </p>
                            </x-slot:price>
                        </x-pricing-card>
                    </div>
                </section>
                <section class="md:px-12.5 lg:px-17.5">
                    <div class="px-10 py-12 lg:py-16 flex flex-col items-center gap-10 text-center">
                        <p class="font-heading text-2.5xl lg:text-3xl font-[350] text-white">
                            Vous avez un projet&nbsp;?<br>Parlons-en.
                        </p>
                        <x-button href="mailto:contact@code16.fr" variant="white" size="lg">
                            <x-button-arrow class="-ml-3" />
                            Parlons de votre projet
                        </x-button>
                    </div>
                </section>
            </div>

        </div>
    </div>
</x-layout>
