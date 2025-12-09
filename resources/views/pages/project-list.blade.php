
<x-layout>
    <x-title>
        Projets
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:surtitle>
            Projets
        </x-slot:surtitle>
        <x-slot:title>
            Chacun de nos projets est une solution à une problématique singulière
        </x-slot:title>
{{--        <div class="mt-5 flex flex-col md:flex-row flex-wrap gap-y-1.25 gap-x-5">--}}
{{--            @foreach([--}}
{{--                'Exigence',--}}
{{--                'Suivi',--}}
{{--                'Autonomie',--}}
{{--            ] as $label)--}}
{{--                <div class="flex items-center gap-1.5">--}}
{{--                    <x-icon-circle-check class="size-4.5 fill-violet-400 text-eggplant" />--}}
{{--                    <div class="font-semibold text-base text-white">--}}
{{--                        {{ $label }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
    </x-hero>
    <div class="mt-10 container">
        <section class="md:px-12.5 lg:px-17.5">
            <div>
{{--                <div class="flex bg-white p-7.5 md:p-12.5 rounded-xl border border-neutral-200">--}}
{{--                    <div>--}}
{{--                        <div class="mb-4 self-end flex items-center gap-0.5">--}}
{{--                            <x-icon-arrow-right-sm class="size-5 text-violet-400" />--}}
{{--                            <h2 class="text-sm font-semibold">--}}
{{--                                Notre approche technique--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                        <p class="text-2xl max-w-3xl min-[23rem]:text-2.5xl font-heading lg:text-3xl font-[350]">--}}
{{--                            Tous nos projets sont conçus sur mesure et construits sur une base technique solide et maîtrisée. Nous assurons leur maintien dans le temps grâce à une suite de test dédiée intégrée au déploiement, des mises à jour régulières des dépendances, un monitoring constant, une gestion rigoureuse des incidents, des sauvegardes systématiques et un haut niveau de sécurité applicative.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            <h2 class="text-base font-medium text-neutral-500">Notre approche</h2>--}}
            <div class="grid grid-cols-1 auto-rows-fr md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5" >
                @foreach([
                    'Exigence' => 'Nous concevons chaque projet avec la même rigueur pour livrer en confiance un code propre, maîtrisé et capable d’évoluer.',
                    'Suivi' => 'Nous assurons la maintenance technique de nos réalisations et les faisons évoluer au rythme des besoins.',
                    'Autonomie' => 'Nous gardons la main sur l’ensemble des briques, du développement au déploiement, pour être autonome et réactifs.',
                ] as $title => $description)
                    <article class="group/item flex flex-row md:flex-col gap-x-1 min-[23rem]:gap-x-3.75 md:gap-6.25 lg:gap-8.75 p-7.5 rounded-2xl  bg-white inset-ring inset-ring-neutral-200">
                        <div class="md:self-stretch">
                            <div class="flex items-center gap-2">
                                <x-coolicon-check class="size-5" />
                                <h3 class="text-2xl font-heading font-[450]">
                                    {{ $title }}
                                </h3>
                            </div>

                            <p class="mt-2 text-base text-neutral-600">
                                {{ $description }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-15 md:mt-20" x-data="{ filterTag: new URL(location.href).searchParams.get('tag') || '' }">
                <div class="relative group py-4 -my-4 -mx-3.75 px-7.5 overflow-x-auto overflow-y-clip flex gap-6">
                    @foreach($tags->prepend(null) as $tag)
                        <a class="shrink-0 relative text-base font-medium aria-current:underline decoration-1 underline-offset-4 text-neutral-500 aria-current:text-eggplant hover:text-eggplant"
                            href="{{ route('projects.index', ['tag' => $tag?->id]) }}"
                            data-tag-id="{{ $tag?->id }}"
                            rel="nofollow"
                            x-bind:aria-current="filterTag === $el.dataset.tagId"
                            x-on:click.prevent="filterTag = $el.dataset.tagId; history.replaceState(null, null, $el.href)"
                        >
                            <span class="absolute -inset-2"> </span>
                            {{ $tag?->label ?: 'Tous' }}
                        </a>
                    @endforeach
                    <div class="shrink-0 md:hidden sticky pointer-events-none z-10 -ml-6 -right-7.5 w-12  bg-linear-to-l from-neutral-100 via-neutral-100 to-transparent"></div>
                </div>

                <x-project-grid class="mt-7.5 md:mt-10 min-h-120 content-start">
                    @foreach($projects as $project)
                        <x-project-item :project="$project" />
                    @endforeach
                </x-project-grid>
            </div>
        </section>
    </div>
</x-layout>
