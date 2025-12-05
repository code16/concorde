
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
    <div class="container">
        <section class="-mt-10 pt-10 bg-white rounded-b-2xl">
            <div class="py-5 md:py-10 px-7.5 md:px-12.5 lg:px-17.5">
                <div class="grid grid-cols-1 divide-y divide-neutral-100">
                    @foreach($articles as $article)
                        <x-article-item :article="$article" horizontal />
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layout>
