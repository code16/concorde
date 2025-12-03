
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
{{--        @if($project->cover)--}}
{{--            <x-slot:img src="{{ $project->cover->thumbnail(1400) }}"></x-slot:img>--}}
{{--        @endif--}}
        @if($project->heading_text)
            <x-slot:heading-text>
                {!! $project->heading_text !!}
            </x-slot:heading-text>
        @endif
    </x-hero>
    <div class="container">
        <div class="-mt-10 pt-10 bg-white rounded-xl">
            <div class="pt-16 pb-24 px-7.5 md:px-12.5 lg:px-17.5">
                <x-content-container>
                    <x-content heading-level="h2">
                        <x-ozu-content>
                            <x-ozu-content::attributes component="ozu-content-image" :project="$project" />
                            {!! $project->content !!}
                        </x-ozu-content>
                    </x-content>
                    @if(count($project->kpis))
                        <ul class="mt-20 grid grid-cols-1 md:grid-cols-[repeat(min(var(--count),3),minmax(0,1fr))] gap-10" style="--count:{{ count($project->kpis) }}">
                            @foreach($project->kpis as $kpi)
                                <li>
                                    <div class="flex items-baseline gap-1 text-6xl font-medium">
                                        {{ $kpi->title }}
                                        <span class="text-5xl">{{ $kpi->suffix }}</span>
                                    </div>
                                    <div class="mt-2 text-lg font-semibold">{{ $kpi->content }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-content-container>
            </div>
        </div>
    </div>
</x-layout>
