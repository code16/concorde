
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
        <div class="
        -mt-10  pt-10 bg-white rounded-xl
{{--         flex justify-start mt-10--}}
         ">
{{--            <div class="p-2 bg-neutral-50 rounded-2xl inset-ring inset-ring-neutral-200">--}}
                <div class="pt-16 pb-24
{{--                    bg-white rounded-xl inset-ring inset-ring-neutral-200 --}}
                    px-7.5 md:px-12.5 lg:px-17.5">
                    <x-content-container>
                        <x-content heading-level="h2">
                            <x-ozu-content>
                                <x-ozu-content::attributes component="ozu-content-image" :project="$project" />
                                {!! $project->content !!}
                            </x-ozu-content>
                        </x-content>
                    </x-content-container>
                </div>
{{--            </div>--}}

        </div>
    </div>
</x-layout>
