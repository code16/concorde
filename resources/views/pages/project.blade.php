
<x-layout :theme-primary="$project->color" :theme-accent="$project->accent_color">
    <x-title>
        {{ $project->title }}
    </x-title>
    <x-slot:header>
        <x-header :variant="$project->color ? 'theme' : 'light'" />
    </x-slot:header>
    <x-hero :variant="$project->color ? 'theme' : 'light'" content-container>
        <x-slot:title>
            {!! $project->title !!}
        </x-slot:title>
        @if($project->heading_text)
            <x-slot:heading-text>
                {!! $project->heading_text !!}
            </x-slot:heading-text>
        @endif
        <div class="mt-3.75 -mb-7.5 text-base text-[oklch(from_var(--theme-primary)_max(calc(l_+_.25),.5)_c_h)]">
            @foreach($project->tags as $tag)
                {{ $tag->label }} @if(!$loop->last) <span class="opacity-50">&bull;</span> @endif
            @endforeach
        </div>
    </x-hero>
    <div class="container">
        <div class="-mt-10 pt-10 bg-white rounded-xl">
            <div class="pt-10 pb-20 md:pt-16 md:pb-24 px-7.5 md:px-12.5 lg:px-17.5">
                <x-content-container>
                    <x-content heading-level="h2">
                        <x-ozu-content>
                            <x-ozu-content::attributes component="ozu-content-image" :project="$project" />
                            {!! $project->content !!}
                        </x-ozu-content>
                    </x-content>
                    @if($project->website_url)
                        <div class="mt-20 flex justify-center">
                            <x-button class="m-auto" variant="link" href="{{ $project->website_url }}">
                                {{ $project->cta_label ?: 'Visiter le site' }}
                                <x-button-arrow />
                            </x-button>
                        </div>
                    @endif
                </x-content-container>
            </div>
        </div>
        @if(count($project->kpis))
            <div class="mt-5 grid grid-cols-1 md:grid-cols-[repeat(min(var(--count),4),minmax(0,1fr))] gap-2.5 md:gap-3.75 lg:gap-5" style="--count:{{ count($project->kpis) }}">
                @foreach($project->kpis as $kpi)
                    <article class="bg-white rounded-xl inset-ring inset-ring-neutral-200 p-7.5">
                        <div class="flex justify-center items-baseline gap-0.5 text-6xl">
                            {{ $kpi->title }}
                            <span class="text-5xl">{{ $kpi->suffix }}</span>
                        </div>
                        <div class="mt-3.5 text-lg text-center font-semibold">{{ $kpi->content }}</div>
                    </article>
                @endforeach
            </div>
        @endif
        @if(count($relatedProjects))
            <section class="flex flex-col mt-20 md:px-12.5 lg:px-17.5">
                <x-section-header>
                    <x-slot:title>
                        Projets similaires
                    </x-slot:title>
                    <x-slot:actions>
                        <x-button href="{{ route('projects.index') }}" variant="link">
                            Voir tous les projets
                            <x-button-arrow />
                        </x-button>
                    </x-slot:actions>
                </x-section-header>
                <x-project-grid class="mt-7.5">
                    @foreach($relatedProjects as $relatedProject)
                        <x-project-item :project="$relatedProject" />
                    @endforeach
                </x-project-grid>
            </section>
        @endif
    </div>
</x-layout>
