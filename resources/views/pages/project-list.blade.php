
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
    </x-hero>
    <div class="mt-10 md:mt-15 container">
        <section class="md:px-12.5 lg:px-17.5">
            <div x-data="{ filterTag: new URL(location.href).searchParams.get('tag') || '' }">
                <div class="relative group py-4 -my-4 -mx-3.75 px-7.5 overflow-x-auto overflow-y-clip flex gap-6">
                    @foreach($tags->prepend(null) as $tag)
                        <a class="shrink-0 relative text-base font-medium aria-current:underline decoration-1 underline-offset-4 opacity-50 aria-current:opacity-100 hover:opacity-100"
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
