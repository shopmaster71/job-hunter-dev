@extends('layouts.app')
@section('title',  'JobHunter - сервис поиска работы')
@section('description', 'JobHunter - сервис поиска работы')
@section('body_class', 'bg-[#F5F6F8]')
@section('assets')
    <link href="{{ asset('assets/slick.css') }}" rel="stylesheet">

@endsection

@section('content')
    <main class="main grow">
        <section class="relative z-10">
            <div class="container mx-auto lg:mt-15">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                    <div class="w-full md:w-4/6 lg:w-1/2">
                        <h1 class="text-3xl mt-10 mb-3 md:text-4xl md:my-11 lg:text-6xl font-bold lg:my-14">От резюме<br/>
                            <span class="text-green-primary">до трудоустойства</span></h1>
                        <p class="text-xl">Ваш помощник в поиске работы</p>
                        <div class="text-sm text-blue-primary mb-2">
                            Ваш город: <strong>{{ session('user_city', 'Москва') }}</strong><br/>
                            Регион: <strong>{{ session('user_region_name') }}</strong><br/>
                            Код: <strong>{{ session('user_region_code') }}</strong><br/>
                            <a href="#" class="text-green-primary underline ml-1 open_popup" rel="popup-city-selector">
                                Изменить
                            </a>
                        </div>
                        <form action="#" method="GET" class="mt-5 md:mt-20 md:mb-15 lg:mt-30 lg:mb-25">
                            <div class="flex flex-row justify-between gap-4">
                                <div class="w-6/8 sm:w-5/8 relative">
                                    <input name="name" type="text" placeholder="Должность, профессия" class="block w-full grow py-2.5 pr-14 pl-6 text-lg text-blue-primary placeholder:text-gray-400 border border-solid border-gray-400 rounded-3xl transition duration-150 ease-in-out outline-none" />
                                    <a href="#" rel="popup-filter" class="open-filter open_popup"><span class="filter-icon"></span></a>
                                </div>
                                <div class="w-2/8 sm:w-3/8">
                                    <button class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Найти <span class="hidden sm:inline">работу</span></button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-5 mb-5 md:mb-10 flex flex-col sm:flex-row justify-start gap-2 sm:gap-4 text-sm sm:text-base md:text-lg leading-none text-blue-primary">
                            <div class="w-full sm:w-1/3">
                                <p class="">Работаем<br/><b class="text-lg sm:text-xl mb:text-2xl">с 2005 года</b></p>
                            </div>
                            <div class="w-full sm:w-1/3">
                                <p><b class="text-lg sm:text-xl mb:text-2xl">500+</b><br/>закрытых<br/> вакансий ежемесячно</p>
                            </div>
                            <div class="w-full sm:w-1/3">
                                <p><b  class="text-lg sm:text-xl mb:text-2xl">Бесплатная</b><br/>база актуальных вакансий</p>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:w-2/6 lg:w-1/2 md:flex justify-end relative">
                        <img src="{{ asset('assets/img/utp-img.png') }}" class="absolute md:-inset-y-25 lg:-inset-y-40 right-0" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="most-relevant-jobs bg-blue-primary lg:mt-30 relative py-5 md:py-10 lg:py-20">
            <div class="container mx-auto">
                @if(count($hrs))
                <div class="mb-10 md:mb-15 lg:mb-20">
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white font-semibold">Лучшие HR-администраторы</h2>
                    <p class="text-white text-lg lg:text-2xl mt-2 lg:mt-4">Помогут вам найти работу</p>
                    <div class="mt-5 lg:mt-10">
                        <div class="hr-slider -mx-3">
                            @foreach($hrs as $hr)
                                <div class="px-3">
                                    <div class="group p-2 hr-slider-card hover:bg-[#26374B] bg-white transition duration-150 ease-in-out rounded-lg box-border">
                                        <div class="hr-slider-card-body flex flex-row justify-start gap-3 min-h-42">
                                            <div class="w-1/4">
                                                <a href="{{route('hr.headhunter', ['slug' => $hr->slug]) }}">
                                                    <img src="{{ asset($hr->photoUrl) }}" class="w-full" alt="{{ 'HR-менеджер '.$hr->name.' '.$hr->surname }}" style="border-radius: 50%;" />
                                                </a>
                                            </div>
                                            <div class="w-3/4">
                                                <a href="{{route('hr.headhunter', ['slug' => $hr->slug]) }}">
                                                    <span class="text-[#929292] text-xs">{{ $hr->name.' '.$hr->surname }}</span>
                                                    <h5 class="mt-1 text-lg/5 font-medium group-hover:text-white">{{ $hr->getInformation->advantage }}</h5>
                                                    <div class="w-full flex flex-row justify-between items-center gap-2 group-hover:text-white">
                                                        <div class="flex flex-row items-center gap-1 font-medium my-2">
                                                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.03506 14.06L3.45108 17.1857L4.69822 10.9091L0 6.56434L6.35474 5.81088L9.03506 0L11.7153 5.81088L18.07 6.56434L13.3719 10.9091L14.619 17.1857L9.03506 14.06Z" fill="#27A746"/>
                                                            </svg>
                                                            <span>4.8</span>
                                                        </div>
                                                        <span class="block pr-3">Стаж, лет: {{ $hr->getInformation->experience }}</span>
                                                    </div>
                                                    <p class="text-[#929292] text-xs mt-1">{{ $hr->getInformation->services }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @if(count($employers))
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white font-semibold">Топ работодателей</h2>
                    <div class="relevant-jobs-hits grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 mt-5 sm:mt-10 w-full">
                        @foreach($employers->take(8) as $employer)
                            <div class="group bg-[#26374B] hover:bg-white transition duration-150 ease-in-out rounded-lg box-border">
                                <a href="{{ route('employer.profile', ['slug' => $employer->slug]) }}" class="block px-5 py-3 sm:px-6 sm:py-5">
                                    <h4 class="text-white group-hover:text-blue-primary text-lg sm:text-xl font-medium">{{ $employer->title }}</h4>
                                    <p class="text-white group-hover:text-blue-primary font-medium sm:pt-1 pb-1 sm:pb-2.5">вакансии {{ count($employer->getVacancyList) }}</p>
                                    <p class="text-sm text-[#c4c4c4] group-hover:text-[#929292]">{{ Str::limit($employer->about, 50)  }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                        @if(count($employers) > 8)
                            <div class="category_hide relevant-jobs-hits grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6 mt-3 sm:mt-6 w-full" wfd-invisible="true" style="display: none;">
                                @foreach($employers->skip(8) as $employer)
                                    <div class="group bg-[#26374B] hover:bg-white transition duration-150 ease-in-out rounded-lg box-border">
                                        <a href="{{ route('employer.profile', ['slug' => $employer->slug]) }}" class="block px-5 py-3 sm:px-6 sm:py-5">
                                            <h4 class="text-white group-hover:text-blue-primary text-lg sm:text-xl font-medium">{{ $employer->title }}</h4>
                                            <p class="text-white group-hover:text-blue-primary font-medium sm:pt-1 pb-1 sm:pb-2.5">вакансии {{ count($employer->getVacancyList) }}</p>
                                            <p class="text-sm text-[#c4c4c4] group-hover:text-[#929292]">{{ Str::limit($employer->about, 50)  }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="more-job-hits w-full mb-5 sm:mb-0 sm:w-66 mt-5 sm:mt-15">
                                <button class="more-jobs btn-utp-green inline w-full grow py-4 px-2 text-white text-lg font-semibold bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Ещё работодатели</button>
                            </div>
                        @endif
                    @endif
            </div>
        </section>
        <section class="top-vacancies overflow-hidden">
            <div class="top-vacancies-wrapper relative py-5 md:py-10 lg:py-20">
                <div class="container mx-auto">
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-blue-primary font-semibold">Топ вакансии дня</h2>
                    <div class="top-vacancies-body flex flex-col lg:flex-row justify-between gap-4 mt-4 lg:mt-10">
                        <div class="top-vacancies-list w-full lg:w-7/10">
                            @if(count($vacancies))
                            <div class="vacancies grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                                @foreach($vacancies as $vacancy)
                                    <div class="top-vacancy-item">
                                        <h5 class="t-v-header pl-5 text-base md:text-lg leading-none font-semibold text-blue-primary relative">{{ $vacancy->position }}</h5>
                                        <p class="top-vacancy-item-price pl-5 pt-1.5 md:py-1.5 text-lg md:text-xl font-semibold text-blue-primary">
                                            @if($vacancy->salary_min)
                                                <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                            @else
                                                <span class="">По договорённости</span>
                                            @endif
                                        </p>
                                        <a href="{{ route('vacancy.show', ['slug' => $vacancy->slug]) }}" class="block top-vacancy-item-link pl-5"><span class="inline-block">{{ $vacancy->organization }}</span></a>
                                    </div>
                                @endforeach
                            </div>

                                <div class="more-job-hits w-full sm:w-66 mt-5">
                                <a href="{{ route('vacancy.list') }}" class="btn-utp-green block text-center w-full py-4 px-2 text-white text-lg font-semibold bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Все вакансии</a>
                                </div>

                            @endif
                        </div>
                        <div class="hidden lg:block top-vacancies-img w-3/10">
                            <img src="{{ asset('assets/img/top-vacancies-img.png') }}"  alt="Топ вакансии дня" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(count($news))
        <section class="news mt-8 lg:mt-18">
            <div class="container mx-auto">
                <div class="news-wrapper flex flex-col lg:flex-row justify-between gap-6">
                    <div class="news-list w-full lg:w-8/12">
                        <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-blue-primary font-semibold w-full lg:w-5/10">Последние новости рынка труда</h2>
                        <div class="news-list grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 w-full mt-5 lg:mt-15">
                            @foreach($news->take(2) as $item)
                                <div class="news-list-item bg-white  px-3 py-3 sm:px-5 sm:py-5 md:px-10 md:py-10 rounded-lg">
                                    <a href="{{ route('news.show', ['slug' => $item->slug]) }}" class="block text-blue-primary">
                                        <div class="news-item-icon">
                                            <img src="{{ asset('assets/img/news-item-img.svg') }}" width="42" height="42" class="responsive" alt="Новости рынка труда" />
                                        </div>
                                        <h4 class="font-semibold text-base md:text-lg lg:text-2xl/7 py-3 md:py-6">{{ Str::limit($item->title, 35) }}</h4>
                                        <p class="text-base/5 md:text-lg/6">{{ Str::limit($item->content, 65) }}</p>
                                    </a>
                                </div>
                            @endforeach
                            <div class="news-list-item news-list-link relative bg-blue-primary px-5 py-5 md:px-10 md:py-10 col-span-1 md:col-span-2 rounded-lg">
                                <h3 class="text-white font-semibold text-lg md:text-2xl/7 lg:text-[40px]/12 w-full lg:w-3/4">На рынке труда каждый день изменения</h3>
                                <p class="text-white text-base/5 md:text-lg/6 mt-3 lg:mt-7 pr-5 lg:pr-30">Каждый день на рынке труда происходят качественные изменения. Мы для вас подбираем самые актуальные новости по
                                    этой теме. Это поможет вам быстрее найти ту работу, к которой вы стремитесь.</p>
                                <div class="more-job-hits w-full mt-5 lg:mt-12">
                                    <a href="{{ route("news.list") }}" class="btn-utp-green block text-center w-full py-4 px-2 text-white text-lg font-semibold bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Все нововсти</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news-list w-full lg:w-4/12">
                        <div class="news-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-3 lg:gap-6 w-full">
                            @foreach($news->skip(2) as $item)
                                <div class="news-list-item bg-white px-3 py-3 sm:px-5 sm:py-5 md:px-10 md:py-10 rounded-lg">
                                    <a href="{{ route('news.show', ['slug' => $item->slug]) }}" class="block text-blue-primary">
                                        <div class="news-item-icon">
                                            <img src="{{ asset('assets/img/news-item-img.svg') }}" width="42" height="42" class="responsive" alt="Новости рынка труда" />
                                        </div>
                                        <h4 class="font-semibold text-base md:text-lg lg:text-2xl/7 py-3 md:py-6">{{ Str::limit($item->title, 35) }}</h4>
                                        <p class="text-base md:text-lg/6">{{ Str::limit($item->content, 50) }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
    <!--Фильтры начало-->
    <div class="popup popup-primary popup-filter  w-[360px] ml-[-180px] sm:w-[600px] sm:ml-[-300px]">
        <div class="popup_header py-2 relative">
            <h3 class="text-2xl text-blue-primary font-medium">Фильтр</h3>
            <div class="close_popup"></div>
        </div>
        <div class="popup_body">
            <form action="" class="mt-3">
                <div class="grid grid-cols-2 gap-3 w-full">
                    <div class="field-input w-4/4 col-span-2">
                        <input name="name" type="text" placeholder="Должность, профессия" class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary placeholder:text-gray-400 border border-solid border-gray-400 rounded-3xl transition duration-150 ease-in-out outline-none" />
                    </div>
                    <div class="white-filter-block bg-white col-span-2">
                        <select class="select block w-full new_select" name="room_type_id">
                            <option value="0" selected>Отрасль/сфера деятельности</option>
                            <option value="1">Медицина</option>
                            <option value="2">Строительство</option>
                            <option value="3">Производство</option>
                            <option value="4">Сельское хозяйство</option>
                            <option value="5">Бытовые услуги</option>
                        </select>
                    </div>
                    <div class="white-filter-block  bg-white col-span-2">
                        <h4 class="text-blue-primary font-semibold text-lg">Уровень зарплаты</h4>
                        <div class="slider-container w-full relative h-12">
                            <div class="slider-track absolute bg-[#cccccc] h-0.5 mt-[37px] w-full z-1"></div>
                            <div class="slider-track-fill absolute bg-green-primary h-0.5 mt-[37px] z-2 left-0" id="trackFill"></div>
                            <input type="range" id="minHandle" min="10000" max="300000" value="10000" step="10000" />
                            <input type="range" id="maxHandle" min="10000" max="300000" value="300000" step="10000" />
                            <div class="labels text-blue-primary flex justify-between font-semibold text-xl mt-2.5">
                                <span id="minLabel">10000</span>
                                <span  id="maxLabel">300000</span>
                            </div>
                        </div>
                    </div>
                    <div class="white-filter-block bg-white col-span-2">
                        <h4 class="text-blue-primary font-semibold text-lg">Опыт работы</h4>
                        <div class="filter-container mb-2">
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check0" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check0">Не имеет значения</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check1" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check1">Нет опыта</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check2" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check2">Более 1 года</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check3" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check3">Более 3 лет</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check4" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check4">Более 6 лет</label>
                            </div>
                        </div>
                    </div>
                    <div class="white-filter-block bg-white col-span-2">
                        <h4 class="text-blue-primary font-semibold text-lg">Тип занятости</h4>
                        <div class="filter-container mb-2">
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check5" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check5">Полная</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check6" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check6">Частичная</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check7" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check7">Удалёнка</label>
                            </div>
                        </div>
                    </div>
                    <div class="white-filter-block bg-white col-span-2">
                        <h4 class="text-blue-primary font-semibold text-lg">Дата публикации</h4>
                        <div class="filter-container mb-2">
                            <div class="flex items-center mt-2">
                                <label class="relative flex items-center cursor-pointer" for="f-radio-0">
                                    <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-0">
                                    <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 text-blue-primary cursor-pointer text-base/3" for="f-radio-0">Последние 24 часа</label>
                            </div>
                            <div class="flex items-center mt-2">
                                <label class="relative flex items-center cursor-pointer" for="f-radio-1">
                                    <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-1">
                                    <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 text-blue-primary cursor-pointer text-base/3" for="f-radio-1">3 дня</label>
                            </div>
                            <div class="flex items-center mt-2">
                                <label class="relative flex items-center cursor-pointer" for="f-radio-2">
                                    <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-2">
                                    <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 text-blue-primary cursor-pointer text-base/3" for="f-radio-2">Неделя</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-button-container col-span-2">
                        <div class="flex flex-row justify-between gap-3 lg:gap-6">
                            <div class="w-1/2">
                                <button class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Применить</button>
                            </div>
                            <div class="w-1/2">
                                <button class="block w-full grow py-2.5 px-2 text-blue-primary text-lg border border-solid border-[#cccccc] rounded-3xl cursor-pointer transition duration-150 ease-in-out outline-none" type="clear">Очистить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Фильтры конец-->
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        $(document).on('ready', function() {
            $(".hr-slider").slick({
                dots: false,
                autoplay:false,
                arrows:true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 980,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows:false,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows:false,
                            dots: true,
                        }
                    }
                ]
            });
        });
    </script>
@endpush
