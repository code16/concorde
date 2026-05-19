
<div class="rounded-2xl bg-white border border-neutral-200 overflow-hidden">
    <div class="px-7 py-5 flex  gap-2">
        <x-icon-ozu class="w-16 text-violet-800" />
        <div class="flex items-baseline gap-2">
            <span class="text-eggplant/50">vs</span>
            <h3 class="text-eggplant text-2xl font-heading font-[450]">{{ $title }}</h3>
        </div>
    </div>
    <div class="p-7 border-t border-neutral-200">
        {{ $slot }}
    </div>

</div>
