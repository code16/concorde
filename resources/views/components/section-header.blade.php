@props(['vertical' => false])

<div class="flex flex-col text-center {{ !$vertical ? 'md:items-end md:flex-row md:text-left' : '' }} gap-x-10">
    <div class="flex-1">
        <div class="mb-2 flex justify-center {{ !$vertical ? 'md:justify-start' : '' }} items-center gap-0.5">
            <x-icon-arrow-right-sm class="size-5 text-violet-400" />
            <h2 class="text-sm font-semibold">{{ $surtitle }}</h2>
        </div>
        <p class="font-heading text-2.5xl [&_br]:max-md:hidden md:text-3xl font-[450] md:font-[350]">
            {{ $title }}
        </p>
    </div>
    @if($headingText ?? null)
        <div class="mt-2.5 {{ !$vertical ? 'md:mt-0' : '' }} text-base text-eggplant">
            {{ $headingText }}
        </div>
    @endif
    @if($actions ?? null)
        <div class="mt-5 md:mt-0">
            {{ $actions }}
        </div>
    @endif
</div>
