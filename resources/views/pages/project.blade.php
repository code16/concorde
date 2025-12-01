
<x-layout>
    <x-title>
        {{ $project->title }}
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:title>
            {{ $project->title }}
        </x-slot:title>
        @if($project->heading_text)
            <x-slot:heading-text>
                {!! $project->heading_text !!}
            </x-slot:heading-text>
        @endif
    </x-hero>
    <div class="container">
        <div class="@container -mt-10  pt-10 bg-white rounded-xl">
            <div class=" py-16 px-7.5 md:px-12.5 lg:px-17.5">
                <x-content class="w-[65ch] mx-auto" heading-level="h2">
                    <x-ozu-content>
                        {!! $project->content !!}
                    </x-ozu-content>
                </x-content>
            </div>
        </div>
    </div>
</x-layout>
