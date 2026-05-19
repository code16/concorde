

<div class="flex flex-col p-7.5 ">
    <h3 class="mb-3 text-base font-medium">{{ $title }}</h3>
    <div class="flex-1 text-base text-white/60 font-normal">
        {{ $slot }}
    </div>
    <div class="mt-6 grid grid-cols-1 gap-y-4">
        {{ $price }}
    </div>
</div>
