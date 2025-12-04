
<x-layout>
    <x-title>
        {{ $article->title }}
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <div class="container">
        <div class="-mt-10  pt-10 bg-white rounded-xl">
            <div class="pb-7.5 pt-16 px-7.5 md:pb-16 md:px-12.5 lg:px-17.5">
                <x-content-container>
                    <div class="mb-12">
                        <h1 class="text-3xl md:text-4xl font-[650]">
                            {!! $article->title !!}
                        </h1>
                        <p class="mt-4 text-neutral-600">{{ $article->publication_date->locale('en')->isoFormat('ll') }} by {{ $article->author->name }}</p>
                    </div>

                    <x-content heading-level="h2">
                        <x-ozu-content>
                            {!! $article->content !!}
                        </x-ozu-content>
                    </x-content>

                    <div class="mt-12">
                        <div class="flex">
                            <div class="rounded-xl p-4 pr-6 border border-neutral-200 ">
                                <div class="flex items-center gap-x-4 gap-y-1.5">
                                    <img class="shrink-0 size-10 rounded-full" src="{{ $article->author->squarePicture }}" alt="{{ $article->author->name }}">
                                    <div>
                                        <h2 class="text-sm text-neutral-600">Author</h2>
                                        <div class="mt-1.5">
                                            <div class="text-base font-semibold">
                                                {{ $article->author->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-content-container>
            </div>
        </div>
    </div>
</x-layout>
