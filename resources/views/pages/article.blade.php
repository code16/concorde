
<x-layout>
    <x-title>
        {{ $article->title }}
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <div class="container">
        <div class="-mt-10  pt-10 bg-white rounded-xl">
            <div class="py-16 px-7.5 md:px-12.5 lg:px-17.5">
                <x-content-container>
                    <x-content heading-level="h2">
                        <x-ozu-content>
                            {!! $article->content !!}
                        </x-ozu-content>
                    </x-content>
                    <div class="mt-8 text-base">
                        {{ $article->author->name }}
                    </div>
                </x-content-container>
            </div>
        </div>
    </div>
</x-layout>
