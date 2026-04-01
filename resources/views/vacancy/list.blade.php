@extends('layouts.app')
@section('title',  'Соискателям')
@section('description', 'Соискателям')
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow">
        <section class="py-3 md:py-0 h-full overflow-hidden">
            <div class="container mx-auto h-full">
                <div class=" flex flex-col md:flex-row items-start justify-start w-full h-full relative">
                    <aside class="with-aside bg-white md:bg-[#F5F6F8] w-full md:w-1/3 relative py-0 md:py-7 pr-o md:pr-5 rounded-tr-xl rounded-br-xl">
                        <a href="#" class="open-filters vacancies-filter-button mb-3 block md:hidden text-blue-primary text-lg font-semibold"><span>Фильтры</span></a>
                        <form action="" class="hidden md:block hid-filters">
                            <div class="grid md:block grid-cols-2 gap-3 w-full">
                                <div class="field-input mb-0 md:mb-3 w-4/4 col-span-2">
                                    <input name="name" type="text" placeholder="Должность, профессия" class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary placeholder:text-gray-400 border border-solid border-gray-400 rounded-3xl transition duration-150 ease-in-out outline-none" />
                                </div>
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md col-span-2">
                                    <select class="select block w-full new_select" name="room_type_id">
                                        <option value="0" selected>Отрасль/сфера деятельности</option>
                                        <option value="1">Медицина</option>
                                        <option value="2">Строительство</option>
                                        <option value="3">Производство</option>
                                        <option value="4">Сельское хозяйство</option>
                                        <option value="5">Бытовые услуги</option>
                                    </select>
                                </div>
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md col-span-2">
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
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="font-semibold text-lg">Опыт работы</h4>
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
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check0">Не имеет значения</label>
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
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check1">Нет опыта</label>
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
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check2">Более 1 года</label>
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
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check3">Более 3 лет</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check4" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check4">Более 6 лет</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="font-semibold text-lg">Тип занятости</h4>
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
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check5">Полная</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check6" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check6">Частичная</label>
                                        </div>
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check7" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2 text-base/3" for="f-check7">Удалёнка</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="font-semibold text-lg">Город или регион</h4>
                                    <div class="w-full relative my-3">
                                        <input name="filter-location" type="text" value="Москва" readonly class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary border border-solid border-[#cccccc] rounded-3xl transition duration-150 ease-in-out outline-none" />
                                        <a href="#" class="open_popup filter-location-regions absolute top-3.5 right-3" rel="regions"><span></span></a>
                                    </div>
                                </div>
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="font-semibold text-lg">Дата публикации</h4>
                                    <div class="filter-container mb-2">
                                        <div class="flex items-center mt-1 lg:mt-3">
                                            <label class="relative flex items-center cursor-pointer" for="f-radio-0">
                                                <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                              border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-0">
                                                <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                              transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 cursor-pointer text-base/3" for="f-radio-0">Последние 24 часа</label>
                                        </div>
                                        <div class="flex items-center mt-1 lg:mt-3">
                                            <label class="relative flex items-center cursor-pointer" for="f-radio-1">
                                                <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                              border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-1">
                                                <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                              transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 cursor-pointer text-base/3" for="f-radio-1">3 дня</label>
                                        </div>
                                        <div class="flex items-center mt-1 lg:mt-3">
                                            <label class="relative flex items-center cursor-pointer" for="f-radio-2">
                                                <input name="role" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                              border border-[#cccccc] checked:border-[#cccccc] transition-all" id="f-radio-2">
                                                <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                              transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                            </label>
                                            <label class="ml-2 cursor-pointer text-base/3" for="f-radio-2">Неделя</label>
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
                    <div class="with-aside-content w-full md:w-2/3 pl-0 md:pl-5">
                        <div class="w-full bg-blue-primary px-3 py-3 text-white rounded-lg">
                            <div class="flex flex-row justify-between items-center gap-3">
                                <div>
                                    <a href="#" class="text-white text-base/4"><span class="vacancies-sorting-item new relative pl-8">Сначала новые</span></a>
                                </div>
                                <div class="hidden sm:block">
                                    <a href="#" class="text-white text-base/4"><span class="vacancies-sorting-item salary relative pl-8">По зарплате</span></a>
                                </div>
                                <div class="hidden lg:block">
                                    <a href="#" class="text-white text-base/4"><span class="vacancies-sorting-item relevant relative pl-8">По релевантности</span></a>
                                </div>
                                <div>
                                    <a href="?view=grid" class="text-white text-base/4"><span class="vacancies-sorting-item columns relative pl-8"></span></a>
                                    <a href="?view=list" class="text-white text-base/4"><span class="vacancies-sorting-item list relative pl-8"></span></a>
                                </div>
                            </div>
                        </div>
                        @if(count($vacancies))
                            @if(request('view') === 'list')
                                <div class="mt-2 px-0 md:px-4">
                                    @foreach($vacancies as $vacancy)
                                        <div class=" bg-white  py-3 mt-3 last:border-0 border-b border-[#cccccc]">
                                            <div class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-3">
                                                <div class="w-full sm:w-2/3">
                                                    <h4 class="font-semibold text-lg/5">{{ $vacancy->position }}</h4>
                                                    <p class="text-[#53575C] mt-1">{{ $vacancy->organization }}</p>
                                            </div>
                                            <div class="flex flex-row justify-between items-start gap-3 sm:gap-6">
                                                <p class="font-bold text-xl/5">
                                                    @if($vacancy->salary_min)
                                                        <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                                    @else
                                                        <span class="">По договорённости</span>
                                                    @endif
                                                </p>
                                                @if(auth()->user()?->role == 1)
                                                    <a href="{{ route('favorite.toggle', ['vacancy' => $vacancy->id]) }}"
                                                       class="favourites-black-link {{ $vacancy->is_favorited ? 'active' : '' }}">
                                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16.7153 0C20.217 0 23.0556 2.88194 23.0556 6.91667C23.0556 14.9861 14.4097 19.5972 11.5278 21.3264C8.64583 19.5972 0 14.9861 0 6.91667C0 2.88194 2.88194 0 6.34028 0C8.48441 0 10.375 1.15278 11.5278 2.30556C12.6806 1.15278 14.5711 0 16.7153 0ZM12.6044 17.9877C13.6206 17.3476 14.5365 16.7101 15.3952 16.027C18.8291 13.295 20.75 10.3099 20.75 6.91667C20.75 4.19699 18.9782 2.30556 16.7153 2.30556C15.475 2.30556 14.1322 2.96161 13.158 3.93583L11.5278 5.56611L9.89752 3.93583C8.92328 2.96161 7.58055 2.30556 6.34028 2.30556C4.10281 2.30556 2.30556 4.21513 2.30556 6.91667C2.30556 10.3099 4.22639 13.295 7.66037 16.027C8.51903 16.7101 9.43491 17.3476 10.4512 17.9877C10.7953 18.2046 11.1371 18.4132 11.5278 18.6464C11.9185 18.4132 12.2603 18.2046 12.6044 17.9877Z"
                                                                  class="fill-current"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-base/5 my-3 pr-0 sm:pr-11">{{ Str::limit($vacancy->charge, 150) }}</p>
                                        <p class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-6 pr-0 sm:pr-11">
                                            <span class="text-lg">{{ $vacancy->city_name }}, {{ $vacancy->address }}</span>
                                            <span class="text-sm text-[#53575C]">{{ $vacancy->publishedAtFormatted }}</span>
                                        </p>
                                        <div class="mt-6 mb-3">
                                            <a href="{{ route('vacancy.show', ['slug' => $vacancy->slug]) }}" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Подробнее</a>
                                        </div>
                                    </div>
                            @endforeach
                            </div>
                        @else
                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">
                                @foreach($vacancies as $vacancy)
                                    <div class="bg-[#F5F6F8] px-4 py-3 rounded-lg">
                                        <div class="flex flex-row justify-between items-start gap-1 sm:gap-3">
                                            <div class="vacancy-card-header">
                                                <h4 class="truncate font-semibold text-lg/5">{{ $vacancy->position }}</h4>
                                                <p class="text-[#53575C] mt-1">{{ $vacancy->organization }}</p>
                                                <p class="font-bold text-xl/5 mt-2">
                                                    @if($vacancy->salary_min)
                                                        <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                                    @else
                                                        <span class="">По договорённости</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="">
                                                @if(auth()->user()?->role == 1)
                                                    <a href="{{ route('favorite.toggle', ['vacancy' => $vacancy->id]) }}"
                                                       class="favourites-black-link {{ $vacancy->is_favorited ? 'active' : '' }}">
                                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16.7153 0C20.217 0 23.0556 2.88194 23.0556 6.91667C23.0556 14.9861 14.4097 19.5972 11.5278 21.3264C8.64583 19.5972 0 14.9861 0 6.91667C0 2.88194 2.88194 0 6.34028 0C8.48441 0 10.375 1.15278 11.5278 2.30556C12.6806 1.15278 14.5711 0 16.7153 0ZM12.6044 17.9877C13.6206 17.3476 14.5365 16.7101 15.3952 16.027C18.8291 13.295 20.75 10.3099 20.75 6.91667C20.75 4.19699 18.9782 2.30556 16.7153 2.30556C15.475 2.30556 14.1322 2.96161 13.158 3.93583L11.5278 5.56611L9.89752 3.93583C8.92328 2.96161 7.58055 2.30556 6.34028 2.30556C4.10281 2.30556 2.30556 4.21513 2.30556 6.91667C2.30556 10.3099 4.22639 13.295 7.66037 16.027C8.51903 16.7101 9.43491 17.3476 10.4512 17.9877C10.7953 18.2046 11.1371 18.4132 11.5278 18.6464C11.9185 18.4132 12.2603 18.2046 12.6044 17.9877Z"
                                                                  class="fill-current"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-base/5 my-3">{{ Str::limit($vacancy->charge, 100) }}</p>
                                        <p class="flex flex-col lg:flex-row justify-between items-start gap-1 lg:gap-3">
                                            <span class="text-lg/6 max-w-full lg:max-w-7/12">{{ $vacancy->city_name }}, {{ $vacancy->address }}</span>
                                            <span class="text-sm text-[#53575C]">{{ $vacancy->publishedAtFormatted }}</span>
                                        </p>
                                        <div class="mt-6 mb-3">
                                            <a href="{{ route('vacancy.show', ['slug' => $vacancy->slug]) }}" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Подробнее</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @endif
                        <div class="mt-5 pl-0 sm:mt-10 sm:pl-6">
                            {{ $vacancies->appends(['view' => request('view')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection



