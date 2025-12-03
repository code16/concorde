@props([
    'home' => false,
    'img' => null,
    'contentContainer' => false,
    /** @var 'dark'|'light' $variant */'variant',
])
@aware(['themeAccent'])

<div class="container">
    <div class="relative flex flex-col isolate overflow-clip rounded-2xl -mt-21.5 pt-21.5
    {{ match($variant) {
        'dark' => 'bg-[#0B0617]',
        'light' => 'bg-eggplant',
        'theme' => 'bg-(--theme-primary)',
} }}
    ">
        <div class="absolute inset-0 bottom-60 bg-linear-to-b from-[oklch(from_var(--theme-primary)_calc(l_-_.1)_c_h)] to-[oklch(from_var(--theme-primary)_l_c_h)]"></div>
        <div class="flex-1 flex flex-col relative isolate overflow-clip
        {{ $home ? 'min-h-135 py-25 md:pt-32.5 md:pb-42.5' : 'pt-7.5 pb-15 md:pt-25 md:pb-32.5' }}
        {{ match($variant) {
            // (bool) $img => 'justify-end pb-20  bg-linear-to-t from-black/60 via-transparent via-80% to-transparent',
            'dark' => 'bg-linear-to-b from-[#0A0515] to-[#1C0F36] ',
            'light' => 'bg-linear-to-b from-eggplant to-[rgb(41,18,79)]',
            'theme' => '',
        } }}
        px-7.5 md:px-12.5 lg:px-17.5">
            @if($variant === 'theme')
                <x-icon-bg-grid-theme
                    class="absolute  -z-10 -top-4 -right-103.5 md:-right-40.5 lg:-right-21.5 w-190
                        {{
                            $themeAccent
                                ? 'text-[oklch(from_var(--theme-accent)_l_c_h)]
                                [&_#lines-gradient-from]:[stop-color:oklch(from_var(--theme-accent)_l_c_h)]
                                [&_#lines-gradient-to]:[stop-color:oklch(from_var(--theme-accent)_l_c_h_/_0%)]'
                                : 'text-[oklch(from_var(--theme-primary)_max(calc(l_+_.15),.4)_c_h)]
                                [&_#lines-gradient-from]:[stop-color:oklch(from_var(--theme-primary)_max(calc(l_+_.15),.4)_c_h)]
                                [&_#lines-gradient-to]:[stop-color:oklch(from_var(--theme-primary)_max(calc(l_+_.15),.4)_c_h_/_0%)]'
                         }}
                    "
                />
            @else
                <x-icon-bg-grid class="absolute  -z-10 -top-4 -right-103.5 md:-right-40.5 lg:-right-21.5 w-190" />
            @endif

            <x-content-container :enabled="$contentContainer">
                <div class="{{ $contentContainer ? 'max-w-110 md:max-w-142' : 'max-w-110 md:max-w-142 lg:max-w-180' }}">
                    @if($surtitle ?? null)
                        <p class="mb-2.5 font-medium text-base {{
                            match($variant) {
                                'dark' => 'text-violet-400',
                                'light' => 'text-violet-400',
                                'theme' => 'text-[oklch(from_var(--theme-primary)_max(calc(l_+_.25),.5)_c_h)]',
                            }
                        }}">
                            {{ $surtitle }}
                        </p>
                    @endif
                    <h1 class="font-heading font-[450] text-4xl md:text-5xl lg:text-6xl text-heading text-white">
                        {{ $title }}
                    </h1>
                    @if($headingText ?? null)
                        <p class="mt-3.75 text-base font-medium {{
                            match($variant) {
                                'dark' => 'text-neutral-250',
                                'light' => 'text-neutral-250',
                                'theme' => 'text-[oklch(from_var(--theme-primary)_max(calc(l_+_.4),.7)_c_h)]',
                            }
                        }}">
                            {{ $headingText }}
                        </p>
                    @endif
                    {{ $slot }}
                </div>
            </x-content-container>
        </div>
    </div>
</div>
