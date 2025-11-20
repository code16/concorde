
<header class="grid grid-cols-1 h-14">
    <x-container class="border-b">
        <x-slot:inner class="flex">
            <a href="{{ route('home') }}" class="group/button w-39 relative isolate flex items-center px-4 border-r ">
                <div class="absolute -z-10 inset-1 scale-0 pointer-events-none group-hover/button:scale-100 transition ease-out duration-200 bg-neutral-900 invert-100"></div>
                <x-icon-logo class="w-full h-4" />
                <div class="absolute inset-1 backdrop-invert-100 scale-0 pointer-events-none group-hover/button:scale-100 transition ease-out duration-200"></div>
            </a>
            <div class="ml-auto shrink-0 grid grid-cols-1 border-l">
                <button class="md:hidden px-6" aria-label="Toggle menu">
                    <x-icon-menu class="size-5" />
                </button>
                <div class="
                max-md:hidden
                 flex items-center px-6 gap-x-6">
                    @foreach ([
                        'Home' => route('home'),
                        'Work' => route('projects.index'),
                        'Views' => route('articles.index'),
                    ] as $label => $url)
                        <a href="{{ $url }}" class="relative block text-body-t4 underline-offset-2 hover:underline">
                            <span class="absolute -inset-x-2 -inset-y-3"></span>
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </x-slot:inner>
    </x-container>
</header>
