
<x-layout>
    <x-title>
        Articles
    </x-title>
    <x-slot:header>
        <x-header variant="light" />
    </x-slot:header>
    <x-hero variant="light">
        <x-slot:surtitle>
            Articles
        </x-slot:surtitle>
        <x-slot:title>
            Blog
        </x-slot:title>
    </x-hero>
    <div class="mt-15 container">
        <section class="md:px-12.5 lg:px-17.5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-12">
                @foreach($articles as $article)
                    <x-article-item :article="$article" />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
