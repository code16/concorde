@props([
    /** @var \App\Models\Project $project */
    'project'
])
<article class="relative rounded-[1.25rem] bg-neutral-50 p-2 pb-3.75 lg:pb-5 inset-ring inset-ring-neutral-200 transition hover:bg-eggplant">
    <div class="rounded-[0.9375rem] bg-white px-10 py-7.5 md:p-8.75 lg:py-11.25 lg:px-12.5 inset-ring inset-ring-neutral-200">
        <h3 class="text-2.5xl lg:text-3xl font-heading font-[450]">
            {{ $project->title }}
        </h3>
        <div class="mt-2.5 text-base text-neutral-600">
            {!! $project->item_text !!}
        </div>
        <div class="mt-5 flex gap-1.75">
            @foreach($project->tags as $tag)
                <x-tag :color="$tag->color">
                    {{ $tag->label }}
                </x-tag>
            @endforeach
        </div>
    </div>
    <div class="mt-3.75 lg:mt-5 px-5">
        <a class="group/btn font-semibold text-neutral-950 hover:text-white text-base flex justify-between gap-4" href="{{ $project->url() }}">
            <span class="absolute rounded-[1.25rem] inset-0"></span>
            Découvrir le projet
            <x-button-arrow />
        </a>
    </div>
</article>
