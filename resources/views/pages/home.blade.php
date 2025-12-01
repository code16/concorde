

<x-layout home>
    <x-slot:header>
        <x-header variant="dark" home />
    </x-slot:header>
    <x-hero variant="dark" home>
        <x-slot:surtitle>
            Artisans du web
        </x-slot:surtitle>
        <x-slot:title>
            Nous développons des projets web faits pour durer.
        </x-slot:title>
        <x-slot:heading-text>
            Depuis 2007, nous concevons et maintenons avec exigence des projets web ou mobiles, en étroite collaboration avec nos clients.
        </x-slot:heading-text>

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
    </x-hero>
    <div class="mt-12.5 md:mt-20 container">
        <div class="grid grid-cols-1 gap-y-20 lg:gap-y-30">
            <section id="projects" class="flex flex-col md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Projets
                    </x-slot:surtitle>
                    <x-slot:title>
                        Découvrez nos projets à la une,
                        <br>reflet de la diversité de nos missions.
                    </x-slot:title>
                    <x-slot:actions>
                        <x-button href="{{ route('projects.index') }}" variant="link">
                            <x-button-arrow />
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
            <div id="approach" class="grid grid-cols-1 gap-y-[inherit]">
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

                    <div class="mt-10 grid grid-cols-1 auto-rows-fr md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5" >
                        @foreach([
                            'Exigence' => 'Nous concevons chaque projet avec la même rigueur pour livrer avec confiance un code propre, maîtrisé et capable d’évoluer.',
                            'Suivi' => 'Nous assurons la maintenance technique de nos réalisations et les faisons évoluer au rythme des besoins.',
                            'Autonomie' => 'Nous gardons la main sur l’ensemble des briques, du développement au déploiement, pour être autonome et réactifs.',
                        ] as $title => $description)
                            <article class="group/item flex flex-row md:flex-col gap-x-1 min-[23rem]:gap-x-3.75 md:gap-6.25 lg:gap-8.75 p-2 rounded-2xl  bg-white inset-ring inset-ring-neutral-200">
                                <div class="self-stretch shrink-0 w-20 min-[23rem]:w-25 md:w-full md:h-30 lg:h-40 bg-violet-50 inset-ring inset-ring-violet-100 rounded-xl">
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
            <div id="team" class="grid grid-cols-1 gap-y-[inherit]">
                <section class="md:px-7.5 lg:px-17.5">
                    <x-section-header vertical>
                        <x-slot:surtitle>
                            L’équipe
                        </x-slot:surtitle>
                        <x-slot:title>
                            Une équipe experte à taille humaine
                        </x-slot:title>
                        <x-slot:heading-text>
                            Pour les projets d’envergure, nous sommes entourés de partenaires de confiance.
                        </x-slot:heading-text>
                    </x-section-header>
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-2.5 md:gap-3.75 lg:gap-5">
                        {{-- TeamMember is a Sushi model, edit values in model class --}}
                        @foreach($teamMembers as $teamMember)
                            <article class="flex items-center md:items-start md:flex-col bg-white rounded-xl inset-ring inset-ring-neutral-200 md:bg-transparent md:inset-ring-0">
                                <img class="size-25 inset-ring inset-ring-neutral-200 md:w-full md:h-auto md:aspect-227/270 lg:aspect-332/360 rounded-xl object-cover object-top" src="{{ $teamMember->picture }}" alt="{{ $teamMember->name }}">
                                <div class="p-4 pl-5 md:p-0 md:mt-3.75 lg:mt-5">
                                    <h3 class="font-heading font-[450] text-xl lg:text-2xl">
                                        {{ $teamMember->name }}
                                    </h3>
                                    <p class="mt-0.5 text-sm md:text-base text-neutral-600">
                                        {{ $teamMember->role }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
                <section class="md:px-7.5 lg:px-17.5">
                    <div x-data="{ atStart: false, atEnd: false }">
                        <x-section-header>
                            <x-slot:surtitle>
                                Témoignages
                            </x-slot:surtitle>
                            <x-slot:title>
                                Ils nous font confiance
                            </x-slot:title>
                            <x-slot:actions class="hidden md:flex gap-3.75" x-show="!atStart || !atEnd">
                                <button class="relative grid place-content-center size-6 rounded-full text-white bg-eggplant disabled:bg-neutral-400 disabled:pointer-events-none hover:text-eggplant hover:bg-violet-400 transition"
                                    x-bind:disabled="atStart"
                                    x-on:click="$refs.scroller.scrollBy({ left: $refs.scroller.children[0].offsetWidth * -1, behavior: 'smooth' })"
                                >
                                    <span class="absolute -inset-1"></span>
                                    <x-icon-arrow-left class="size-4.5" />
                                </button>
                                <button class="relative grid place-content-center size-6 rounded-full text-white bg-eggplant disabled:bg-neutral-400 disabled:pointer-events-none hover:text-eggplant hover:bg-violet-400 transition"
                                    x-bind:disabled="atEnd"
                                    x-on:click="$refs.scroller.scrollBy({ left: $refs.scroller.children[0].offsetWidth, behavior: 'smooth' })"
                                >
                                    <span class="absolute -inset-1"></span>
                                    <x-icon-arrow-right class="size-4.5" />
                                </button>
                            </x-slot:actions>
                        </x-section-header>
                        <div class="mt-10 flex overflow-x-auto scrollbar-none snap-x snap-mandatory scroll-px-2 -mx-3.75 px-3.75 md:scroll-px-2 md:px-0 md:-mx-2"
                            x-ref="scroller"
                            x-init="
                            [...$el.children]
                                .sort(() => Math.random() - 0.5)
                                .forEach(child => $el.appendChild(child));
                            new IntersectionObserver(entries => { atStart = entries[0].isIntersecting }, { root: $refs.scroller, threshold: 1 }).observe($el.children[0]);
                             new IntersectionObserver(entries => { atEnd = entries[0].isIntersecting }, { root: $refs.scroller, threshold: 1 }).observe($el.children[$el.children.length - 1]);
                             $refs.scroller.scrollLeft = 0;
                        "
                        >
                            @foreach($testimonials as $i => $testimonial)
                                <div class="shrink-0 snap-start w-[min(100%,19.75rem)] md:w-1/2 xl:w-1/3 px-2">
                                    <article
                                        class="relative md:w-full bg-white rounded-xl inset-ring inset-ring-neutral-200 p-10"
                                        data-index="{{ $i }}"
                                    >
                                        <h3 class="sr-only">{{ $testimonial->title }}</h3>
                                        <figure>
                                            <figcaption class="flex gap-2.5 items-center">
                                                @if($testimonial->authorPicture)
                                                    <img class="size-11.5 border border-eggplant rounded-full" src="{{ $testimonial->authorPicture->thumbnail(80) }}" alt="{{ $testimonial->author_name }}">
                                                @endif
                                                <div>
                                                    <p class="text-base font-bold">
                                                        {{ $testimonial->author_name }}
                                                    </p>
                                                    <p class="text-base font-medium text-neutral-600">
                                                        {{ $testimonial->author_role }}
                                                    </p>
                                                </div>
                                            </figcaption>
                                            <blockquote class="mt-7.5 md:mt-10 text-lg md:text-xl font-heading font-[450]">
                                                {!! $testimonial->content !!}
                                            </blockquote>
                                        </figure>
                                        @if($testimonial->logo)
                                            <img class="mt-10 md:mt-12.5 h-10 object-contain opacity-20" src="{{ $testimonial->logo->downloadUrl() }}" alt="{{ $testimonial->title }}">
                                        @endif
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <section id="blog" class="flex flex-col md:px-7.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:surtitle>
                        Blog
                    </x-slot:surtitle>
                    <x-slot:title class="md:max-w-90 lg:max-w-138">
                        Nos projets, nos outils, et tout ce qu’on aime partager avec vous.
                    </x-slot:title>
                    <x-slot:actions>
                        <x-button href="{{ route('articles.index') }}" variant="link">
                            <x-button-arrow />
                            Explorer le blog
                        </x-button>
                    </x-slot:actions>
                </x-section-header>
                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                    @foreach($articles as $article)
                        <x-article-item :article="$article" home />
                    @endforeach
                </div>
            </section>
        </div>
    </div>


{{--    <img class="container" src="/screen.png">--}}
</x-layout>
