
<x-layout theme-primary="var(--color-blue-800)">
    <x-title>
        Ozu, traiter les petits projets comme les grands
    </x-title>
    <x-slot:head-start>
        @vite('resources/js/hls.js')
    </x-slot:head-start>
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
        <div class="-mt-16 md:-mt-52 md:px-12.5 lg:px-17.5 pb-16 mb-20 lg:mb-30">
            <div class="group @container-size relative aspect-16/9 isolate bg-eggplant shadow-xl"
                x-data="{ playing: false, showing: false }"
                :data-showing="showing"
                :data-playing="playing"
            >
                <div class="size-full overflow-hidden">
                    <div class="relative isolate size-full bg-violet-500 group-hover:scale-115 transition duration-300"
                        x-on:click="showing = true; playing = true"
                        x-show="!showing"
                    >
                        <img src="{{ Vite::asset('resources/img/ozu/video-cover-bg.avif') }}" alt="Ozu Video Cover" class="absolute inset-0 size-full object-cover" />
                        <x-icon-ozu class="absolute top-[30%] md:top-1/2 left-1/2 -translate-1/2 size-[20%] text-white" />
                    </div>
                </div>
                <video class="absolute size-full inset-0" x-cloak x-show="showing"
                    poster="{{ Vite::asset('resources/img/ozu/video-cover-bg.avif') }}"
                    data-playlist="https://vz-c309594d-4f1.b-cdn.net/e83c368c-42bf-4058-bf15-0380d5405295/playlist.m3u8"
                    @env('production')
                        data-preload
                    @endenv
                    disablepictureinpicture
                    x-on:play="playing = true"
                    x-on:pause="playing = false; $el.controls = true"
                    x-init="
                        const video = $el;
                        const playlistUrl = $el.getAttribute('data-playlist');
                        if (Hls.isSupported()) {
                            const hls = new Hls({
                                autoStartLoad: $el.hasAttribute('data-preload'),
                                maxBufferLength: 3,
                                maxMaxBufferLength: 3,
                                startLevel: 4,
                            });
                            hls.loadSource(playlistUrl);
                            hls.attachMedia(video);
                            video.addEventListener('play', () => {
                                hls.config.maxBufferLength = 30;
                                hls.config.maxMaxBufferLength = 30;
                                hls.startLoad();
                            }, { once: true });
                        }
                        // Fallback for browsers that support HLS natively (Safari)
                        else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                            video.src = playlistUrl;
                        }
                    "
                    x-effect="playing ? $el.play() : $el.pause()"
                    x-ref="video"
                ></video>
                <x-button class="absolute bottom-0 left-1/2 -translate-x-1/2 -translate-y-[15cqh] in-data-showing:translate-y-[calc(100%+1rem)]  transition duration-300 overflow-hidden px-5! [interpolate-size:allow-keywords] [transition-behavior:discrete] gap-0!"
                    size="lg" variant="light"
                    x-bind:data-variant="showing ? 'dark' : 'light'"
                    aria-label="Lancer la vidéo"
                    x-on:click="showing = true; playing = !playing"
                    x-cloak
                >
                    <span class="absolute inset-0"></span>
                    <x-icon-play class="size-8 in-data-playing:opacity-0 transition duration-300" />
                    <x-icon-pause class="size-8 absolute left-1/2 top-1/2 -translate-1/2 opacity-0 in-data-playing:opacity-100 duration-300" />
                    <span class="in-data-showing:opacity-0 in-data-showing:w-0 transition-[opacity,width] duration-300 whitespace-nowrap">
                        <span class="px-3">
                            Découvrir Ozu en une minute
                        </span>
                    </span>
                </x-button>
{{--                    <div class="absolute inset-0 opacity-0 in-data-playing:opacity-100">--}}
{{--                        <div style="position:relative;padding-top:56.25%;"><iframe src="https://player.mediadelivery.net/embed/665748/e83c368c-42bf-4058-bf15-0380d5405295?autoplay=false&loop=false&compactControls=true&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;fullscreen;" allowfullscreen></iframe></div>--}}
{{--                    </div>--}}
            </div>
        </div>
        <div class="grid grid-cols-1 gap-y-20 lg:gap-y-30">
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        <h2>
                            Pourquoi Ozu ?
                        </h2>
                    </x-slot:surtitle>
                    <x-slot:title>
                        <p>
                            Les avantages d’un hébergement statique,<br>sans les inconvénients
                        </p>
                    </x-slot:title>
                </x-section-header>
                <ul class="mt-10 grid grid-cols-1 auto-rows-fr md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5" >
                    @foreach([
                        'Rapide, stable et sécurisé' => 'Un site statique est fait de fichiers pré-calculés, le rendant très performant et le mettant à l’abri de la grande majorité des attaques.',
                        'Gestion de contenu sur mesure' => 'Vos clients peuvent gérer leur contenu en autonomie avec un dashboard moderne et pensé pour être simple d’utilisation.',
                        'Maintenance technique complète' => 'Nous appliquons même garantie de maintenance que sur les gros projets, assurant continuité de service et évolutivité.',
                    ] as $title => $description)
                        <li class="group/item flex flex-row md:flex-col gap-x-1 min-[23rem]:gap-x-3.75 md:gap-6.25 lg:gap-8.75 p-2 rounded-2xl  bg-white inset-ring inset-ring-neutral-200">
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
                        </li>
                    @endforeach
                </ul>
            </section>
            <div class="grid grid-cols-1 gap-y-10">
                <section class="md:px-12.5 lg:px-17.5">
                    <div class="rounded-2xl overflow-hidden bg-white border border-neutral-200">
                        <div class="grid grid-cols-1 md:grid-cols-5">
                            <div class="md:order-1 md:col-span-2 overflow-hidden min-h-48 bg-purple-50 relative">
                                <img class="absolute top-12 left-6 w-[700px] max-w-none drop-shadow-2xl" src="{{ Vite::asset('resources/img/ozu/figma-screen.png') }}" alt="">
                            </div>
                            <div class="md:col-span-3 p-7 lg:p-12 flex flex-col justify-center gap-5">
                                <x-section-header>
                                    <x-slot:surtitle>
                                        <h3>
                                            Sur-mesure
                                        </h3>
                                    </x-slot:surtitle>
                                    <x-slot:title>
                                        <p>
                                            Votre design,<br>intégralement respecté
                                        </p>
                                    </x-slot:title>
                                </x-section-header>
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
                                <img class="absolute inset-0 w-full h-full object-cover" src="{{ Vite::asset('resources/img/ozu/europe.jpg') }}" alt="">
                            </div>
                            <div class="md:col-span-3 p-7 lg:p-12 flex flex-col justify-center gap-5">
                                <x-section-header>
                                    <x-slot:surtitle>
                                        <h3>
                                            Souveraineté
                                        </h3>
                                    </x-slot:surtitle>
                                    <x-slot:title>
                                        <p>
                                            Ozu est 100% européen
                                        </p>
                                    </x-slot:title>
                                </x-section-header>
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
                        <h2>
                            Notre expertise CMS
                        </h2>
                    </x-slot:surtitle>
                    <x-slot:title>
                        <p>
                            Nous sommes des spécialistes<br>de la gestion de contenu
                        </p>
                    </x-slot:title>
                </x-section-header>
                <div class="mt-10 rounded-2xl overflow-hidden border border-neutral-200">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="bg-white border-b md:border-b-0 md:border-r border-neutral-200 p-7 lg:p-12 flex flex-col gap-5">
                            <p class="text-neutral-600 max-w-prose">
                                Depuis des années, Code&nbsp;16 développe et maintient <a href="https://sharp.code16.fr" target="_blank" class="font-medium text-violet-700 underline underline-offset-2 hover:text-violet-900">Sharp</a>,
                                un framework open source de gestion de contenu utilisé sur des centaines de projets.
                            </p>
                            <p class="text-neutral-600 max-w-prose">
                                Nous savons qu’un CMS mal pensé génère de la frustration et des erreurs&nbsp;: le dashboard Ozu est conçu avec soin,
                                proposant dans une interface épurée des champs adaptés au contenu réel de chaque projet sans fonctionnalité superflue.
                            </p>
                            <p class="text-neutral-600 max-w-prose">
                                L’objectif est que chaque client soit autonome dès la livraison.
                            </p>
                        </div>
                        <div class="bg-white border-neutral-200 p-7 lg:p-12 flex flex-col justify-center gap-6">
                            <ul class="space-y-4">
                                @foreach([
                                    'Un CMS configuré précisément selon le contenu du site, sans champ inutile',
                                    'Des interfaces pensées pour des utilisateurs non techniques',
                                    'Une prise en main immédiate, sans formation longue ni documentation à lire',
                                    'Une expérience forgée sur des années de développement de Sharp',
                                ] as $point)
                                    <li class="flex gap-3 items-start">
                                        <x-icon-circle-check class="size-5 fill-violet-600 text-violet-50 shrink-0 mt-0.5" />
                                        <span class="text-neutral-700 text-base">{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="bg-purple-50 flex items-center justify-center p-4 lg:p-10">
                        <img class="w-full rounded-lg shadow-xl"
                             src="{{ Vite::asset('resources/img/ozu/sharp-dashboard.avif') }}"
                            loading="lazy"
                             alt="Interface de gestion de contenu Sharp">
                    </div>
                </div>
            </section>
            <section class="md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        <h2>
                            Comparer
                        </h2>
                    </x-slot:surtitle>
                    <x-slot:title>
                        <p>
                            En quoi Ozu est-il différent<br>d’autres solutions ?
                        </p>
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
                        <h2>
                            Cas d’utilisation
                        </h2>
                    </x-slot:surtitle>
                    <x-slot:title>
                        <p>
                            De nombreux types de projets<br>sont parfaitement adaptés à Ozu
                        </p>
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

        </div>
        <div class="mt-12 lg:mt-20 rounded-3xl bg-eggplant text-white pt-12 lg:pt-20">
            <section class="px-5 md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        <h2>
                            Tarification simple
                        </h2>
                    </x-slot:surtitle>
                    <x-slot:title>
                        <p>
                            Des délais réduits,<br>et une facture plus légère
                        </p>
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
                <div class="px-10 py-12 lg:py-20 flex flex-col items-center gap-10 text-center">
                    <p class="font-heading text-2.5xl lg:text-3xl font-[350] text-white">
                        Vous avez un projet&nbsp;?<br>Parlons-en.
                    </p>
                    <x-button href="mailto:contact@code16.fr" variant="light" size="lg">
                        <x-button-arrow class="-ml-3" />
                        Parlons de votre projet
                    </x-button>
                </div>
            </section>
        </div>
    </div>
</x-layout>
