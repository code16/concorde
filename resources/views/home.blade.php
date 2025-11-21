

<x-layout>
    <x-slot:header>
        <x-header home />
    </x-slot:header>
    <div class="container">
        <div class="rounded-2xl bg-[#0B0617]">
            <div class="relative isolate overflow-clip rounded-b-2xl min-h-[540px] bg-[linear-gradient(180deg,#0A0515,#1C0F36)] px-7.5 py-25 md:px-12.5 md:pt-32.5 md:pb-42.5 lg:px-17.5">
                <x-icon-bg-grid class="absolute -z-10 -top-4 -right-21.5 w-190" />
                <div class="max-w-172">
                    <p class="mb-2.5 font-medium text-violet-400 text-base">
                        Artisans du web
                    </p>
                    <h1 class="font-heading font-[450] text-6xl text-heading text-white">
                        Nous développons des projets web fait pour durer.
                    </h1>
                    <p class="mt-3.75 text-base font-medium text-neutral-250">
                        Depuis 2007, nous concevons et maintenons avec rigueur et exigeance des projets web et mobiles, en étroite collaboration avec nos clients.
                    </p>
                    <div class="mt-5 flex flex-col md:flex-row flex-wrap gap-5">
                        @foreach([
                            'Experts Laravel',
                            'Développement sur-mesure',
                            'Technologies open source',
                        ] as $label)
                            <div class="flex items-center gap-1.5">
                                <x-icon-circle-check class="size-4.5 fill-violet-400 text-eggplant" />
                                <div class="font-semibold text-base text-white">
                                    {{ $label }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img class="container" src="/screen.png">
</x-layout>
