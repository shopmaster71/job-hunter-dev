@extends('layouts.app')
@section('title',  'Поиск компании')
@section('description', 'Поиск компании')
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
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <h4 class="font-semibold text-lg">Опыт работы</h4>
                                    <div class="mb-2">
                                        <div class="flex items-start mt-1 lg:mt-3">
                                            <label class="flex items-center cursor-pointer relative">
                                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check0" />
                                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                            </label>
                                            <label class="cursor-pointer ml-2  text-base/3" for="f-check0">Не имеет значения</label>
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
                                            <label class="cursor-pointer ml-2  text-base/3" for="f-check1">Нет опыта</label>
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
                                            <label class="cursor-pointer ml-2  text-base/3" for="f-check2">Более 1 года</label>
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
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check5">Полная</label>
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
                                            <label class="cursor-pointer ml-2 text-blue-primary text-base/3" for="f-check6">Частичная</label>
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
                                <div class="mb-0 md:mb-3 bg-white py-0 px-0 md:py-3 md:px-4 md:rounded-md">
                                    <div class="flex items-start mt-1 lg:mt-3">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="f-check11" />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                        </label>
                                        <label class="cursor-pointer ml-2 text-base/4" for="f-check11">Показать компании, у которых нет открытых вакансий</label>
                                    </div>
                                </div>
                                <div class="my-1 md:my-8 col-span-2">
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
                    <div class="with-aside-content w-full md:w-2/3 pl-0 md:pl-10">
                        <h1 class="text-lg lg:text-2xl font-semibold">Поиск компании</h1>

                        <div class="my-5">
                            <div class="w-full relative my-3">
                                <input name="company-search" type="text" value="СмартИнновации" class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary border border-solid border-[#cccccc] rounded-3xl transition duration-150 ease-in-out outline-none" />
                                <button class="open_popup filter-location-regions absolute top-3.5 right-3" rel="regions">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0ZM9 16C12.8675 16 16 12.8675 16 9C16 5.1325 12.8675 2 9 2C5.1325 2 2 5.1325 2 9C2 12.8675 5.1325 16 9 16ZM17.4853 16.0711L20.3137 18.8995L18.8995 20.3137L16.0711 17.4853L17.4853 16.0711Z" fill="#0B2641"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-7">
                                <a href="#" class="text-[#1c729a] font-semibold">A</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Б</a>
                                <a href="#" class="text-[#1c729a] font-semibold">В</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Г</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Д</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Е</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ё</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ё</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ж</a>
                                <a href="#" class="text-[#1c729a] font-semibold">З</a>
                                <a href="#" class="text-[#1c729a] font-semibold">И</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Й</a>
                                <a href="#" class="text-[#1c729a] font-semibold">К</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Л</a>
                                <a href="#" class="text-[#1c729a] font-semibold">М</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Н</a>
                                <a href="#" class="text-[#1c729a] font-semibold">О</a>
                                <a href="#" class="text-[#1c729a] font-semibold">П</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Р</a>
                                <a href="#" class="text-[#1c729a] font-semibold">С</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Т</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Р</a>
                                <a href="#" class="text-[#1c729a] font-semibold">С</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Т</a>
                                <a href="#" class="text-[#1c729a] font-semibold">У</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ф</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Х</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ц</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ч</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ш</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Щ</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Э</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Ю</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Я</a>
                                <br/>
                                <br/>
                                <a href="#" class="text-[#1c729a] font-semibold">A</a>
                                <a href="#" class="text-[#1c729a] font-semibold">B</a>
                                <a href="#" class="text-[#1c729a] font-semibold">C</a>
                                <a href="#" class="text-[#1c729a] font-semibold">D</a>
                                <a href="#" class="text-[#1c729a] font-semibold">E</a>
                                <a href="#" class="text-[#1c729a] font-semibold">F</a>
                                <a href="#" class="text-[#1c729a] font-semibold">G</a>
                                <a href="#" class="text-[#1c729a] font-semibold">H</a>
                                <a href="#" class="text-[#1c729a] font-semibold">I</a>
                                <a href="#" class="text-[#1c729a] font-semibold">J</a>
                                <a href="#" class="text-[#1c729a] font-semibold">K</a>
                                <a href="#" class="text-[#1c729a] font-semibold">L</a>
                                <a href="#" class="text-[#1c729a] font-semibold">M</a>
                                <a href="#" class="text-[#1c729a] font-semibold">N</a>
                                <a href="#" class="text-[#1c729a] font-semibold">O</a>
                                <a href="#" class="text-[#1c729a] font-semibold">P</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Q</a>
                                <a href="#" class="text-[#1c729a] font-semibold">R</a>
                                <a href="#" class="text-[#1c729a] font-semibold">S</a>
                                <a href="#" class="text-[#1c729a] font-semibold">T</a>
                                <a href="#" class="text-[#1c729a] font-semibold">U</a>
                                <a href="#" class="text-[#1c729a] font-semibold">V</a>
                                <a href="#" class="text-[#1c729a] font-semibold">W</a>
                                <a href="#" class="text-[#1c729a] font-semibold">X</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Y</a>
                                <a href="#" class="text-[#1c729a] font-semibold">Z</a>
                                <br/>
                                <br/>
                                <a href="#" class="text-[#1c729a] font-semibold">0-9</a>
                                <p class="mt-5">компаний найдено: <b><span class="diviger">{{ count($employers) ?: 0 }}</span></b></p>
                            </div>
                        </div>
                        @if(count($employers))
                            <div class="grid grid-cols-1 md:grid-cols-2 justify-start gap-2 w-full">
                                @foreach($employers as $employer)
                                    <a href="{{ $employer->getContact ? route('employer.profile', ['slug' => $employer->slug]) : '#' }}" class=" text-[#1c729a]">{{ $employer->title }} {{ count($employer->getVacancyList) }} вак.</a>
                                @endforeach
                            </div>
                            <div class="mt-5 sm:mt-15">
                                {{ $employers->links() }}
                            </div>
                        @else
                            <p>Компаний не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
