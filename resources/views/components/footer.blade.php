
<footer class="container mt-12.5 md:mt-20">
    <div class="grid grid-cols-[auto_1fr] gap-y-6 gap-x-5 min-[23rem]:gap-x-10 md:gap-x-17.5 lg:gap-x-37.5 justify-between rounded-xl content-center items-center px-5 min-[23rem]:px-7.5 md:px-12.5 lg:pl-20 lg:pr-37.5 bg-eggplant md:min-h-53.25 py-7.5">
        <x-icon-logo-small class="col-start-1 self-end justify-self-center w-18 md:w-21 text-white" />
        <div class="contents md:flex justify-between">
            <div class="row-span-2 col-start-2 grid grid-cols-1 gap-y-6 md:contents">
                <div class="">
                    <h2 class="uppercase text-xs text-white opacity-40">
                        Nous trouver
                    </h2>
                    <address class="mt-1.5 md:mt-4.75 not-italic text-sm text-white">
                        {!! app(\App\GeneralSettings::class)->address_street !!}
                        <br>
                        {!! app(\App\GeneralSettings::class)->address_city !!}
                    </address>
                </div>
                <div class="">
                    <h2 class="uppercase text-xs text-white opacity-40">
                        Nous contacter
                    </h2>
                    <div class="mt-1.5 md:mt-4.75 text-sm text-white">
                        {{ app(\App\GeneralSettings::class)->contact_email }}
                    </div>
                </div>
            </div>
            <div class="col-start-1 row-start-2 self-start md:self-stretch min-w-22 md:min-w-auto flex flex-col">
                <h2 class="hidden md:block uppercase text-xs text-white opacity-40">
                    Nous suivre
                </h2>
                <div class="mt-auto md:mb-0.5 flex justify-center md:justify-start gap-5">
                    <a class="text-white" aria-label="LinkedIn" href="{{ app(\App\GeneralSettings::class)->linkedin_url }}" target="_blank">
                        <x-icon-linkedin class="size-4" />
                    </a>
                    <a class="text-white" aria-label="Github" href="{{ app(\App\GeneralSettings::class)->github_url }}" target="_blank">
                        <x-icon-github class="size-4" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2 text-center text-neutral-600 text-xs">
        © {{ date('Y') }} Code 16 — built with
        <a class="underline hover:text-eggplant" href="https://ozu.code16.fr" target="_blank">
            Ozu
        </a>
    </div>
</footer>
