@props([
    'home' => false,
    /** @var 'dark'|'light' $variant */'variant',
])

<div class="container">
    <div class="rounded-xl {{ match($variant) { 'dark' => 'bg-[#0B0617]', 'light' => 'bg-eggplant' } }}">
        <div class="bg-[inherit] h-4 -mt-4"></div>
        <div class="relative isolate overflow-clip rounded-b-2xl {{ $home ? 'min-h-135 py-25 md:pt-32.5 md:pb-42.5' : 'pt-25 pb-32.5' }}  bg-linear-to-b
        {{ match($variant) { 'dark' => 'from-[#0A0515] to-[#1C0F36] ', 'light' => 'from-eggplant to-[rgb(41,18,79)]' } }}
        px-7.5 md:px-12.5 lg:px-17.5">
            <x-icon-bg-grid class="absolute  -z-10 -top-4 -right-103.5 md:-right-40.5 lg:-right-21.5 w-190" />
            <div class="max-w-110 md:max-w-142 lg:max-w-180">
                @if($surtitle ?? null)
                    <p class="mb-2.5 font-medium text-violet-400 text-base">
                        {{ $surtitle }}
                    </p>
                @endif
                <h1 class="font-heading font-[450] text-4xl md:text-5xl lg:text-6xl text-heading text-white">
                    {{ $title }}
                </h1>
                @if($headingText ?? null)
                    <p class="mt-3.75 text-base font-medium text-neutral-250">
                        {{ $headingText }}
                    </p>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
