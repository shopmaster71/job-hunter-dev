@extends('layouts.app')
@section('title',  'Поиск HR-менеджера')
@section('description', 'Поиск HR-менеджера')
@section('body_class', 'bg-white')
@section('content')
    <main class="main">
        <section class="py-3 md:py-0 overflow-hidden">
            <div class="container mx-auto">
                <div class=" flex flex-col md:flex-row justify-start items-start w-full relative">
                    <aside class="with-aside bg-white md:bg-[#F5F6F8] w-full md:w-1/3 relative py-0 md:py-7 pr-o md:pr-5 rounded-tr-xl rounded-br-xl">
                        <a href="#" class="open-filters vacancies-filter-button mb-3 block md:hidden text-blue-primary text-lg font-semibold"><span>Фильтры</span></a>
                        <form action="" class="hidden md:block hid-filters">
                            <div class="grid md:block grid-cols-2 gap-3 w-full">
                                <div class="field-input mb-0 md:mb-3 w-4/4 col-span-2">
                                    <div class="w-full relative">
                                        <input name="company-search" type="text" value="Ксения Константинопольская" class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary border border-solid border-[#cccccc] rounded-3xl transition duration-150 ease-in-out outline-none" />
                                        <button class="open_popup filter-location-regions absolute top-3.5 right-3" rel="regions">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0ZM9 16C12.8675 16 16 12.8675 16 9C16 5.1325 12.8675 2 9 2C5.1325 2 2 5.1325 2 9C2 12.8675 5.1325 16 9 16ZM17.4853 16.0711L20.3137 18.8995L18.8995 20.3137L16.0711 17.4853L17.4853 16.0711Z" fill="#0B2641"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="white-filter-block mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md col-span-2">
                                    <select class="select block w-full new_select" name="room_type_id">
                                        <option value="0" selected>Отрасль/сфера деятельности</option>
                                        <option value="Медицина">Медицина</option>
                                        <option value="Строительство">Строительство</option>
                                        <option value="Производство">Производство</option>
                                        <option value="Сельское хозяйство">Сельское хозяйство</option>
                                        <option value="Бытовые услуги">Бытовые услуги</option>
                                    </select>
                                </div>
                                <div class="white-filter-block mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="text-blue-primary font-semibold text-lg">Услуги</h4>
                                    <div class="filter-container mb-2">
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check0" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check0">Карьерная консультация</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check1" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check1">Составление резюме</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check2" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check2">Поиск работы</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check3" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check3">Получение оффера</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="white-filter-block mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <div class="filter-container mb-2">
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check5" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check5">Работа с топ-менеджерами/вакансиями</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="white-filter-block mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <div class="filter-container mb-2">
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check5" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check5">Поиск работы за рубежом</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-button-container my-1 md:my-8 col-span-2">
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
                    </aside>
                    <div class="w-full md:w-2/3 pl-0 md:pl-10">
                        <h1 class="text-lg lg:text-2xl font-semibold">Поиск HR-менеджера</h1>
                        @if(count($hrs))
                        <div class="grid  grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6 mt-3 lg:mt-5">
                            @foreach($hrs as $hr)
                                <div class="group p-2 hover:bg-[#26374B] bg-[#F5F6F8] transition duration-150 ease-in-out rounded-lg box-border">
                                    <div class="flex flex-row justify-start gap-3 min-h-32 sm:min-h-42">
                                        <div class="w-1/4 max-w-16">
                                            <a href="{{route('hr.headhunter', ['slug' => $hr->slug]) }}">
                                                <img src="{{ asset($hr->photoUrl) }}" class="w-full" alt="{{ 'Профиль HR-менеджера '.$hr->name.' '.$hr->surname }}" style="border-radius: 50%;" />
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
                            @endforeach
                        </div>

                        <div class="mt-5 sm:mt-15">
                            {{ $hrs->links() }}

                        </div>
                        @else
                            <p>Не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
