@props([
    'illustration'
])

<li class="group/item flex flex-row lg:flex-col gap-x-1 min-[23rem]:gap-x-3.75 lg:gap-6.25 lg:gap-8.75 p-2 rounded-2xl  bg-white inset-ring inset-ring-neutral-200">
    <div class="self-stretch shrink-0 w-20 min-[23rem]:w-25 lg:w-full lg:h-30 lg:h-40 bg-purple-50 [&_.accent]:fill-violet-400 inset-ring inset-ring-violet-100 rounded-xl">
        @if($illustration === 'demanding')
            <x-icon-approach-demanding class="max-lg:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#diamond]:-translate-y-[5%]" />
            <x-icon-approach-demanding-mobile class="lg:hidden size-full" />
        @elseif($illustration === 'autonomous')
            <x-icon-approach-autonomous class="max-lg:hidden size-full **:transition  **:duration-300 group-hover/item:[&_#pastille]:translate-x-[5%]" />
            <x-icon-approach-autonomous-mobile class="lg:hidden size-full" />
        @elseif($illustration === 'admin')
            <x-icon-approach-admin class="max-lg:hidden size-full **:transition **:duration-300 group-hover/item:[&_#cursor]:-translate-x-[5%]" />
            <x-icon-approach-admin-mobile class="lg:hidden size-full" />
        @elseif($illustration === 'maintenance')
            <x-icon-approach-maintenance class="max-lg:hidden size-full **:transition **:duration-300 group-hover/item:[&_#wrench]:-translate-y-[5%]" />
            <x-icon-approach-maintenance-mobile class="lg:hidden size-full" />
        @endif
    </div>
    <div class="lg:self-stretch p-2.5 lg:pt-0 lg:p-5 lg:pt-0 lg:p-7">
        <h3 class="text-2xl font-heading font-[450]">
            {{ $title }}
        </h3>
        <div class="mt-1.25 text-base text-neutral-600">
            {{ $slot }}
        </div>
    </div>
</li>
