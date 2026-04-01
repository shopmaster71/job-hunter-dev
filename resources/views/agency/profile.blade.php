@extends('layouts.app')
@section('title',  $agency->title)
@section('description', $agency->title)
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow">
        <section class="py-3 md:py-0 overflow-hidden">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row items-start justify-start w-full relative">
                    <aside class="bg-white  w-full md:w-1/3 relative rounded-tr-xl rounded-br-xl">
                        <div class="with-aside bg-white md:bg-[#F5F6F8] w-full relative py-0 md:py-10 pr-o md:pr-5 rounded-tr-xl rounded-br-xl">
                            <div>
                                <a class="text-blue-primary font-semibold text-2xl lg:text-[33px]" href="tel:+{{ preg_replace("/[^0-9]/", "", $agency->phone) }}">{{ $agency->phone }}</a>
                            </div>
                            <div class="my-1 md:my-3">
                                <a class="text-blue-primary font-medium text-lg md:text-2xl" href="mailto:{{ $agency->email }}">{{ $agency->email }}</a>
                            </div>
                            <div class="flex items-center gap-3 mt-3 md:mt-6">
                                @if($agency->vk)
                                    <a href="{{ $agency->vk }}" target="_blank" class="text-blue-primary" >
                                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.14753 11.8099C7.3949 9.52374 10.894 8.01654 12.6447 7.28833C17.6435 5.20916 18.6822 4.84799 19.3592 4.83606C19.5081 4.83344 19.8411 4.87034 20.0567 5.04534C20.2388 5.1931 20.2889 5.39271 20.3129 5.5328C20.3369 5.6729 20.3667 5.99204 20.343 6.2414C20.0721 9.08763 18.9 15.9947 18.3037 19.1825C18.0514 20.5314 17.5546 20.9836 17.0736 21.0279C16.0283 21.1241 15.2345 20.3371 14.2221 19.6735C12.6379 18.635 11.7429 17.9885 10.2051 16.9751C8.42795 15.804 9.58001 15.1603 10.5928 14.1084C10.8579 13.8331 15.4635 9.64397 15.5526 9.26395C15.5637 9.21642 15.5741 9.03926 15.4688 8.94571C15.3636 8.85216 15.2083 8.88415 15.0962 8.9096C14.9373 8.94566 12.4064 10.6184 7.50365 13.928C6.78528 14.4212 6.13461 14.6616 5.55163 14.649C4.90893 14.6351 3.67265 14.2856 2.7536 13.9869C1.62635 13.6204 0.730432 13.4267 0.808447 12.8044C0.849081 12.4803 1.29544 12.1488 2.14753 11.8099Z" fill="#0B2641"/>
                                        </svg>
                                    </a>
                                @endif
                                @if($agency->telegram)
                                <a href="{{ $agency->telegram }}" class="text-blue-primary" target="_blank" >
                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_272_602)">
                                            <path d="M30.1462 15.4108C30.6297 14.7858 31.0135 14.2843 31.297 13.9059C33.3386 11.1916 34.2235 9.45765 33.9523 8.70169L33.8459 8.52465C33.7752 8.4183 33.5919 8.32065 33.2971 8.23225C33.002 8.14392 32.6244 8.12981 32.1643 8.18812L27.0662 8.22408C26.9481 8.21232 26.83 8.21507 26.712 8.23225C26.594 8.2502 26.5174 8.26821 26.4818 8.28539C26.4462 8.3034 26.4169 8.31784 26.3934 8.32959L26.3227 8.38273C26.2637 8.41792 26.1989 8.48006 26.1281 8.56884C26.0573 8.65756 25.9979 8.76039 25.951 8.8788C25.3964 10.3067 24.7651 11.6345 24.0569 12.8619C23.6202 13.5936 23.2187 14.2284 22.8533 14.7647C22.4874 15.3021 22.1806 15.6974 21.9327 15.9506C21.685 16.2043 21.4605 16.4083 21.2601 16.5612C21.0592 16.7152 20.906 16.7797 20.8001 16.7563C20.6937 16.7328 20.5933 16.7094 20.4991 16.6851C20.3338 16.5792 20.2008 16.4349 20.1008 16.2516C20.0004 16.0691 19.9327 15.8388 19.8971 15.5613C19.8619 15.2842 19.8408 15.045 19.8353 14.8441C19.8291 14.6436 19.8322 14.3606 19.8443 13.9943C19.8561 13.6284 19.8619 13.381 19.8619 13.2508C19.8619 12.8029 19.8709 12.3159 19.8886 11.7905C19.9062 11.2656 19.921 10.8493 19.9327 10.5424C19.9445 10.236 19.9503 9.91112 19.9503 9.56872C19.9503 9.22708 19.9296 8.95813 19.888 8.76313C19.8466 8.56884 19.7845 8.38004 19.7024 8.19674C19.6196 8.0142 19.4987 7.87228 19.3392 7.77226C19.1798 7.6718 18.9823 7.59247 18.7463 7.53301C18.1205 7.39109 17.3239 7.31528 16.3565 7.30282C14.1613 7.28015 12.751 7.42162 12.1256 7.72807C11.8778 7.85823 11.6534 8.0349 11.4529 8.25927C11.2403 8.51922 11.211 8.66107 11.3646 8.68374C12.0728 8.79009 12.574 9.04416 12.8691 9.44519L12.9754 9.65743C13.0579 9.81142 13.1404 10.0827 13.2232 10.472C13.3058 10.8614 13.3589 11.2921 13.3827 11.7643C13.4417 12.6258 13.4417 13.363 13.3827 13.9771C13.3237 14.5911 13.2678 15.0688 13.2147 15.4105C13.1615 15.7529 13.0818 16.03 12.9758 16.2422C12.8695 16.4552 12.7988 16.585 12.7632 16.6323C12.7276 16.6792 12.6983 16.7089 12.6749 16.7207C12.5213 16.7793 12.3622 16.809 12.1969 16.809C12.0315 16.809 11.831 16.7261 11.5949 16.5607C11.3588 16.3962 11.1137 16.1687 10.8604 15.8795C10.6063 15.5906 10.3206 15.1861 10.0016 14.6666C9.68304 14.1479 9.35232 13.5338 9.0103 12.8259L8.7273 12.3123C8.55025 11.9824 8.30825 11.5012 8.00142 10.8699C7.69459 10.2386 7.42289 9.62812 7.18721 9.03752C7.09262 8.79009 6.95109 8.60129 6.76236 8.47112L6.67402 8.41798C6.61501 8.37104 6.52042 8.32065 6.39064 8.26783C6.26047 8.21469 6.12526 8.17637 5.98334 8.15254L1.13291 8.18773C0.637288 8.18773 0.301144 8.30034 0.124098 8.52465L0.0533309 8.6306C0.0175641 8.69 0 8.78459 0 8.91399C0 9.04416 0.0355752 9.20326 0.106342 9.39167C0.814589 11.056 1.58466 12.661 2.41643 14.2065C3.24865 15.7529 3.97139 16.9982 4.58505 17.9422C5.19871 18.8869 5.82412 19.7773 6.46166 20.6154C7.0992 21.4534 7.52093 21.99 7.72729 22.2258C7.93366 22.4623 8.09588 22.6394 8.21398 22.757L8.65646 23.1822C8.93947 23.4653 9.35577 23.8045 9.9046 24.2001C10.4534 24.5956 11.0608 24.985 11.7281 25.3681C12.3945 25.7519 13.1708 26.0642 14.0557 26.3066C14.9407 26.5489 15.8022 26.6462 16.6402 26.5985H18.676C19.0891 26.5633 19.4017 26.434 19.6141 26.2092L19.6848 26.1208C19.7317 26.0504 19.7762 25.941 19.8176 25.7936C19.8587 25.6463 19.8799 25.4837 19.8799 25.307C19.8677 24.7997 19.9065 24.3416 19.9948 23.935C20.0831 23.5277 20.1835 23.2213 20.2958 23.0142C20.408 22.8081 20.5346 22.6338 20.6764 22.4919C20.818 22.35 20.918 22.2652 20.9774 22.2355C21.0364 22.2065 21.0838 22.1858 21.119 22.1733C21.402 22.0791 21.7354 22.1706 22.1192 22.4477C22.5027 22.7257 22.8627 23.0672 23.1993 23.4745C23.5353 23.8818 23.9395 24.3388 24.4117 24.8465C24.8836 25.3538 25.2967 25.7314 25.6508 25.9792L26.005 26.1923C26.241 26.3334 26.5475 26.4632 26.9255 26.5816C27.303 26.6993 27.6338 26.729 27.9167 26.67L32.4486 26.5988C32.8969 26.5988 33.2452 26.5254 33.4931 26.3776C33.7408 26.231 33.8883 26.0676 33.9356 25.891C33.9824 25.7139 33.9856 25.5142 33.9446 25.2894C33.9032 25.0654 33.8617 24.909 33.8207 24.8207C33.7793 24.7324 33.7409 24.6581 33.7053 24.5995C33.1152 23.5374 31.9882 22.233 30.3242 20.6872L30.2886 20.652L30.2711 20.634L30.2535 20.6168H30.2357C29.4802 19.8968 29.0025 19.4128 28.8019 19.1646C28.4362 18.6933 28.3533 18.2152 28.5542 17.7313C28.6949 17.3644 29.2257 16.5913 30.1462 15.4108Z" fill="#0B2641"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_272_602">
                                                <rect width="34" height="34" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                    @endif
                            </div>
                            <div class="mt-3 md:mt-8">
                                <a href="#" rel="write" class="open_popup btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Написать нам</a>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-20 with-aside bg-white md:bg-[#F5F6F8] w-full relative py-0 md:py-7 pr-o md:pr-5 rounded-tr-xl rounded-br-xl">
                            <a href="#" class="open-filters vacancies-filter-button mb-3 block md:hidden text-blue-primary text-lg font-semibold"><span>Фильтры</span></a>
                            <form action="" class="hidden md:block hid-filters">
                                <div class="grid md:block grid-cols-2 gap-3 w-full">
                                    <div class="field-input mb-0 md:mb-3 w-4/4 col-span-2">
                                        <div class="w-full relative">
                                            <input name="company-search" type="text" value="Хирург" class="block w-full grow py-2.5 pr-14 pl-4 text-lg text-blue-primary border border-solid border-[#cccccc] rounded-3xl transition duration-150 ease-in-out outline-none" />
                                            <button class="open_popup filter-location-regions absolute top-3.5 right-3" rel="regions">
                                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0ZM9 16C12.8675 16 16 12.8675 16 9C16 5.1325 12.8675 2 9 2C5.1325 2 2 5.1325 2 9C2 12.8675 5.1325 16 9 16ZM17.4853 16.0711L20.3137 18.8995L18.8995 20.3137L16.0711 17.4853L17.4853 16.0711Z" fill="#0B2641"/>
                                                </svg>
                                            </button>
                                        </div>
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
                                        <div class="mb-2">
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
                                        <div class="mb-2">
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
                                                <label class="ml-2  cursor-pointer text-base/3" for="f-radio-2">Неделя</label>
                                            </div>
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
                        </div>
                    </aside>
                    <div class="w-full mt-0 md:mt-4 md:w-2/3 pl-0 md:pl-10">
                        <h1 class="text-2xl lg:text-4xl font-bold">{{ $agency->title }}</h1>
                        <p class="text-lg md:text-2xl my-2 md:my-4">{{ $agency->getInformation->advantage }}</p>

                        <cite class="block text-base lg:text-lg mb-2 lg:mb-3">«{{ $agency->getInformation->about }}»</cite>
                        @if(count($vacancies))
                            <div class="mt-5 md:mt-10">
                                @foreach($vacancies as $vacancy)
                                    <div class=" bg-white py-3 mt-3 last:border-0 border-b border-[#cccccc]">
                                        <div class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-3">
                                            <div class="w-full sm:w-2/3">
                                                <h4 class="font-semibold text-lg/5">{{ $vacancy->position }}</h4>
                                                <p class="text-[#53575C] mt-1">{{ $vacancy->organization }}</p>
                                            </div>
                                            <div class="flex flex-row justify-between items-start gap-3 sm:gap-6">
                                                <p class="font-bold text-base/4">
                                                    @if($vacancy->salary_min)
                                                        <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                                    @else
                                                        <span class="">По договорённости</span>
                                                    @endif
                                                </p>
                                                @if(auth()->user()?->role == 1)
                                                    <a
                                                        href="{{ route('favorite.toggle', ['vacancy' => $vacancy->id]) }}"
                                                        class="favourites-black-link {{ $vacancy->is_favorited ? 'active' : '' }}"
                                                    >
                                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16.7153 0C20.217 0 23.0556 2.88194 23.0556 6.91667C23.0556 14.9861 14.4097 19.5972 11.5278 21.3264C8.64583 19.5972 0 14.9861 0 6.91667C0 2.88194 2.88194 0 6.34028 0C8.48441 0 10.375 1.15278 11.5278 2.30556C12.6806 1.15278 14.5711 0 16.7153 0ZM12.6044 17.9877C13.6206 17.3476 14.5365 16.7101 15.3952 16.027C18.8291 13.295 20.75 10.3099 20.75 6.91667C20.75 4.19699 18.9782 2.30556 16.7153 2.30556C15.475 2.30556 14.1322 2.96161 13.158 3.93583L11.5278 5.56611L9.89752 3.93583C8.92328 2.96161 7.58055 2.30556 6.34028 2.30556C4.10281 2.30556 2.30556 4.21513 2.30556 6.91667C2.30556 10.3099 4.22639 13.295 7.66037 16.027C8.51903 16.7101 9.43491 17.3476 10.4512 17.9877C10.7953 18.2046 11.1371 18.4132 11.5278 18.6464C11.9185 18.4132 12.2603 18.2046 12.6044 17.9877Z"
                                                                class="fill-current"
                                                            />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-base/5 my-3 pr-0 sm:pr-11">{{ $vacancy->charge }}</p>
                                        <p class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-6 @if(auth()->user()?->role == 1) pr-0 sm:pr-11 @endif">
                                            <span class="text-lg">{{ $vacancy->city_name }}, {{ $vacancy->address }}</span>
                                            <span class="text-sm text-[#53575C]">{{ $vacancy->publishedAtFormatted }}</span>
                                        </p>
                                        <div class="mt-6 mb-3">
                                            <a href="{{ route('vacancy.show', ['slug' => $vacancy->slug]) }}" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Подробнее</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $vacancies->links() }}
                        @else
                            <p>Вакансий не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
            <!--Напишите нам начало-->
            <div class="popup popup-primary write w-[352px] -ml-44 sm:w-[600px] sm:ml-[-300px]">
                <div class="popup_header py-2 relative">
                    <h3 class="text-2xl text-blue-primary font-medium">{{ $agency->title }}</h3>
                    <div class="close_popup"></div>
                </div>
                <div class="popup_body">
                    <form action="{{ route('agency.message.create', ['agency' => $agency->id]) }}" method="post">
                        @csrf
                        <span class="text-blue-primary font-medium text-xl">Напишите нам </span>
                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                            <div>
                                <label class="mb-2" for="email">E-mail<sup class="text-red-500">*</sup></label>
                                <input type="email" name="email" id="email" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="example@mail.ru" required />
                            </div>
                            <div>
                                <label class="mb-2" for="phone">Телефон</label>
                                <input type="text" name="phone" id="phone" class="phone block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="+7(000) 000-00-00" />
                            </div>
                        </div>
                        <div class="w-full mt-2 sm:mt-4">
                            <label class="mb-2" for="theme">Тема <sup class="text-red-500">*</sup></label>
                            <input type="text" name="theme" id="theme" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="Тема сообщения" required />
                        </div>
                        <div class="w-full mt-2 sm:mt-4 mb-4">
                            <label class="mb-2" for="message">Сообщение <sup class="text-red-500">*</sup></label>
                            <textarea name="message" rows="5" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" id="message" required>Сообщение </textarea>
                        </div>
                        <x-yandex-captcha />
                        <div class="mt-3">
                            <button class="py-3 px-12 text-white disabled:text-[#8F8F8F] text-base bg-green-primary disabled:bg-[#cccccc] border border-solid disabled:border-[#cccccc] border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Отправить</button>
                        </div>

                    </form>
                </div>
            </div>
            <!--Напишите нам конец-->
        </section>
    </main>

@endsection



