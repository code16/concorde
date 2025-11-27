@props(['vertical' => false])

<div class="grid text-center grid-cols-1 justify-items-center justify-between {{ !$vertical ? 'md:justify-items-start md:grid-cols-[auto_auto] md:text-left' : '' }} gap-x-4 lg:gap-x-10">
    <div class="mb-2 flex justify-center {{ !$vertical ? 'md:col-span-full' : '' }} items-center gap-0.5">
        <x-icon-arrow-right-sm class="size-5 text-violet-400" />
        <h2 class="text-sm font-semibold">{{ $surtitle }}</h2>
    </div>
    <div>
        <p class="font-heading text-2.5xl [&_br]:max-md:hidden md:text-3xl font-[450] md:font-[350] {{ $title->attributes->get('class') }}">
            {{ $title }}
        </p>
    </div>
    @if($headingText ?? null)
        <div class="mt-2.5 {{ !$vertical ? 'md:mt-1 md:max-w-86 xl:max-w-104' : '' }} text-base text-eggplant {{ $headingText->attributes->get('class') }}">
            {{ $headingText }}
        </div>
    @endif
    @if($actions ?? null)
        <div class="mt-5 self-end md:mt-0 {{ $actions->attributes->get('class') }}" {{ $actions->attributes->except('class') }}>
            {{ $actions }}
        </div>
    @endif
</div>
