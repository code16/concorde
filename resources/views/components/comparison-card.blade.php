
<div class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
    <div class="px-7 py-5">
        <h3 class="flex justify-center md:justify-start gap-2">
            <x-icon-ozu class="w-16 lg:w-20 text-violet-800" />
            <span class="lg:mt-1 flex items-baseline gap-2">
                <span class="sr-only">Ozu</span>
                <span class="text-eggplant/50">vs</span>
                <span class="text-eggplant text-xl lg:text-2xl font-heading font-[450]">{{ $title }}</span>
            </span>
        </h3>
    </div>
    <div class="p-7 border-t border-neutral-200">
        {{ $slot }}
    </div>
</div>
