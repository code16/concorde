

<div class="grid md:grid-cols-[minmax(0,1fr)_1px_20rem] items-center rounded-2xl bg-white inset-ring inset-ring-neutral-200">
    <div class="p-7.5 text-lg font-normal">
        {{ $title }}
    </div>
    <div class="h-full border-l border-dashed border-neutral-200"></div>
    <div class="p-7.5  text-center font-bold grid grid-cols-1 gap-y-4">
        {{ $slot }}
    </div>
</div>
