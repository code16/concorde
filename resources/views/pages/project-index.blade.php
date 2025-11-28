
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
            Chacun de nos projets sont une solution à une problématique singulière
        </x-slot:title>
    </x-hero>
    <div class="mt-15 container">
        <section class="md:px-12.5 lg:px-17.5">
            <div x-data="{ filterTag: new URL(location.href).searchParams.get('tag') || '' }">
                <div class="group
{{--                bg-white rounded-xl px-4 py-3--}}
                 flex flex-wrap gap-6">
                    @foreach($tags->prepend(null) as $tag)
                        <a class="relative text-base  font-medium  aria-current:underline decoration-1 underline-offset-4 opacity-50 aria-current:opacity-100 hover:opacity-100
{{--                       py-1 px-2.5 rounded-md aria-current:bg-eggplant aria-current:text-white hover:bg-neutral-100--}}
                        "
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
                </div>

                <div class="mt-10 min-h-120 content-start grid grid-cols-1 md:grid-cols-2 gap-2.5 md:gap-3.75 lg:gap-5">
                    @foreach($projects as $project)
                        <x-project-item :project="$project" />
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layout>
