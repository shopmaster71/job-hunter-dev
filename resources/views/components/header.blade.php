<header class="header py-2 md:py-6 relative z-20">
    <div class="container mx-auto">
        <div class="flex flex-row justify-between items-center gap-3">
            <div class="flex flex-row justify-between items-center gap-5 md:gap-12">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo.svg') }}" alt="JobHunter" />
                    </a>
                </div>
                <div class="relative">
                    <div class="navicon w-[35px] h-[25px] relative cursor-pointer mt-1 block lg:hidden">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="hidden lg:flex flex-row gap-12 text-base">
                        <li><a href="#" class="text-blue-primary transition duration-150 ease-in-out hover:opacity-75">Соискателям</a></li>
                        <li><a href="#" class="text-blue-primary transition duration-150 ease-in-out hover:opacity-75">Работодателям</a></li>
                        <li><a href="#" class="text-blue-primary transition duration-150 ease-in-out hover:opacity-75">Агентам (HR)</a></li>
                        <li><a href="#" class="text-blue-primary transition duration-150 ease-in-out hover:opacity-75">Новости</a></li>
                    </ul>
                </div>
            </div>
            <div>
                @auth()
                    @if(auth()->user()->role == 1)
                        <a href="{{ route('applicant.index') }}" class="button-login transition duration-150 ease-in-out">
                            <span class="inline-block overflow-hidden sm:overflow-visible -indent-[10000px] sm:indent-0">{{ auth()->user()->applicant ? auth()->user()->applicant->name.' '.auth()->user()->applicant->surname : auth()->user()->email }}</span>
                        </a>
                    @endif
                        @if(auth()->user()->role == 4)
                            <a href="{{ route('hr.index') }}" class="button-login transition duration-150 ease-in-out">
                                <span class="inline-block overflow-hidden sm:overflow-visible -indent-[10000px] sm:indent-0">{{ auth()->user()->hr ? auth()->user()->hr->name.' '.auth()->user()->hr->surname : auth()->user()->email }}</span>
                            </a>
                        @endif
                        @if(auth()->user()->role == 2)
                            <a href="{{ route('employer.index') }}" class="button-login transition duration-150 ease-in-out">
                                <span class="inline-block overflow-hidden sm:overflow-visible -indent-[10000px] sm:indent-0">{{ auth()->user()->email }}</span>
                            </a>
                        @endif

                @else
                    <a href="{{ route('login') }}" class="button-login transition duration-150 ease-in-out"><span class="inline-block overflow-hidden sm:overflow-visible -indent-[10000px] sm:indent-0">Вход/Регистрация</span></a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!--Мобильное меню начало-->
<div class="mobile_panel mobile_menu"><!-- panel_open-->
    <div class="mobile_panel-close"></div>
    <div class="mobile_menu-header bg-blue-primary flex flex-row justify-between items-center gap-3 py-3 pl-3 pr-10">
        <div class="mobile_menu-logo">
            <a href="/">
                <img src="{{ asset('assets/img/footer-logo.svg') }}" class="responsive" alt="JobHunter" />
            </a>
        </div>
        <p class="flex flex-row justify-start items-center gap-3">
            <a href="#" class="open_popup" rel="regions" title="Выбор города"><img src="{{ asset('assets/img/map-w.svg') }}" alt=""></a>
            <a href="#" title="Конструктор резюме"><img src="{{ asset('assets/img/boxing-line-w.svg') }}" alt=""></a>
        </p>
    </div>
    <div class="mobile_menu_links px-3 py-3 mt-4">
        <ul>
            <li class="mb-2"><a href="#" class="text-blue-primary hover:opacity-80 transition duration-150 ease-in-out">Соискателям</a></li>
            <li class="mb-2"><a href="#" class="text-blue-primary hover:opacity-80 transition duration-150 ease-in-out">Работодателям</a></li>
            <li class="mb-2"><a href="#" class="text-blue-primary hover:opacity-80 transition duration-150 ease-in-out">Агентам (HR)</a></li>
            <li class="mb-2"><a href="#" class="text-blue-primary hover:opacity-80 transition duration-150 ease-in-out">Услуги</a></li>
            <li class="mb-2"><a href="#" class="text-blue-primary hover:opacity-80 transition duration-150 ease-in-out">Новости</a></li>
        </ul>
    </div>
</div>
<!--Мобильное меню конец-->
