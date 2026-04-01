@extends('layouts.app')
@section('title',  'Новости')
@section('description', 'Новости')
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow ">
        <section class="bg-white">
            <div class="container mx-auto">
                <div class="flex flex-col lg:flex-row gap-2 lg:gap-6">
                    <div class="w-full lg:w-3/10">
                        <h1 class="text-blue-primary text-2xl md:text-3xl lg:text-[40px] font-bold">Новости</h1>
                    </div>
                    <div class="w-full lg:w-7/10">
                        <p class="text-blue-primary text-base lg:text-lg mb-1 lg:mb-2 pr-0 lg:pr-10">Приятно наблюдать, как представители современных социальных
                            резервов, инициированные исключительно синтетически, объединены в целые кластеры себе подобных.</p>
                        <p class="text-blue-primary text-base lg:text-lg mb-1 lg:mb-2 pr-0 lg:pr-10">Также как социально-экономическое развитие в значительной
                            степени обусловливает важность форм воздействия.</p>
                        <form action="#" method="post" class="mt-7 lg:mt-10">
                            <div class="flex flex-row justify-start gap-4">
                                <div class="utp-form-field w-7/10 relative">
                                    <input name="name" type="text" placeholder="Поиск новости"class="block w-full grow py-2.5 pr-14 pl-6 text-lg text-blue-primary placeholder:text-gray-400 border border-solid border-gray-400 rounded-3xl transition duration-150 ease-in-out outline-none" />
                                </div>
                                <div class="utp-form-button w-3/10">
                                    <button class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Найти <span class="hidden sm:inline">новость</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="w-full bg-blue-primary px-3 md:px-5 py-2 md:py-4 text-white rounded-xl mt-7 lg:mt-15">
                    <div class="flex flex-row justify-between items-center gap-3">
                        <div class="hidden sm:block">
                            <div class="flex items-start">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="n-check0" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-white text-base/3" for="n-check0">Для соискателей</label>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-start">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="n-check1" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-white text-base/3" for="n-check1">Для работодателей</label>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-start">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="n-check2" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-white text-base/3" for="n-check2">Тренды рынка</label>
                            </div>
                        </div>
                        <div class="hidden lg:block">
                            <div class="flex items-start">
                                <label class="flex items-center cursor-pointer relative">
                                    <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="n-check3" />
                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                              </span>
                                </label>
                                <label class="cursor-pointer ml-2 text-white text-base/3" for="n-check3">Анонсы мероприятий</label>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="text-white text-base/4"><span class="vacancies-sorting-item news-new relative pl-8">Сначала новые</span></a>
                        </div>
                        <div class="hidden xl:block">
                            <a href="#" class="text-white text-base/4"><span class="vacancies-sorting-item news-popular relative pl-8">По популярности</span></a>
                        </div>
                    </div>
                </div>
                <div class="tags w-full mt-3 md:mt-5 pb-3 md:pb-5 px-0 md:px-10">
                    <div class="block md:flex flex-row justify-start items-center gap-6">
                        <a href="" class="category-news active inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Все</a>
                        <a href="" class="category-news inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Бизнес</a>
                        <a href="" class="category-news inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Законодательство</a>
                        <a href="" class="category-news inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Налоги</a>
                        <a href="" class="category-news inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Кадры</a>
                        <a href="" class="category-news inline-block px-5 py-2 text-blue-primary border border-white text-sm rounded-full  transition-colors duration-200 hover:border-[#8F8F8F] mt-1">Тенденции</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#F5F6F8] py-6 lg:py-12">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row justify-start gap-6 w-full">
                    @if(count($news))
                    <div class="w-full md:w-2/3 flex flex-col gap-3 md:gap-6">
                        @foreach($news as $item)
                        <div class="list-news-item">
                            <a href="{{ route('news.show', ['slug' => $item->slug]) }}">
                                <div class=" flex flex-col sm:flex-row bg-white rounded-lg shadow-lg">
                                    <div class="hidden sm:block news-item-img w-5/12 rounded-lg" style="background:url('{{ asset( $item->image) }}');background-size: cover;">

                                    </div>
                                    <div class="w-full sm:w-7/12 py-5 lg:py-7 pl-5 lg:pl-10 pr-5 lg:pr-23">
                                        <p class="text-[#53575C] opacity-50 flex flex-row justify-between text-base/4">
                                            <span class="list-news-views relative pl-8">{{ $item->views }}</span>
                                            <span>{{ $item->created_at }}</span>
                                        </p>
                                        <h4 class="font-semibold text-lg lg:text-2xl/6 mt-3 lg:mt-6">{{ Str::limit($item->title, 35) }}</h4>
                                        <p class="text-base/4 lg:text-lg/5 mt-2 lg:mt-6 pr-0 lg:pr-10">{{ Str::limit($item->content, 60) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        <div class="mt-5 pl-0 sm:mt-10 sm:pl-6">
                            {{ $news->links() }}
                        </div>
                    </div>


                    <div class="w-full md:w-1/3 flex flex-col gap-6 ">
                        <div class="py-4 px-7 bg-white rounded-lg shadow-lg">
                            <h4 class="font-semibold text-xl lg:lg:text-2xl/6 mb-3">Популярные новости</h4>
                            <div class="list-last-news flex flex-col gap-5">
                                @foreach($popularNews as $item)
                                    <div class="list-last-news-item pb-5 last:border-0 border-b border-[#cccccc]">
                                        <a href="{{ route('news.show', ['slug' => $item->slug]) }}">
                                            <p class="list-news-info text-[#53575C] opacity-50 flex flex-row justify-between text-[14px]/4">
                                                <span class="list-news-views relative pl-7">{{ $item->views }}</span>
                                                <span class="list-news-date">{{ $item->created_at }}</span>
                                            </p>
                                            <h5 class="font-semibold text-lg/6 mt-3 lg:mt-5">{{ Str::limit($item->title, 28) }}</h5>
                                            <p class="text-base/5 mt-1">{{ Str::limit($item->content, 60) }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="py-4 px-7 bg-white rounded-lg shadow-lg">
                            <h4 class="text-blue-primary font-semibold text-xl lg:text-2xl mb-4">Свежие материалы</h4>
                            <div class="list-last-news flex flex-col gap-6">
                                @foreach($freshNews as $item)
                                    <div class="list-last-news-item pb-4 last:border-0 border-b border-[#cccccc]">
                                        <a href="{{ route('news.show', ['slug' => $item->slug]) }}">
                                            <p class="text-[#53575C] opacity-50 flex flex-row justify-between text-[14px]/4">
                                                <span class="list-news-views relative pl-7">{{ $item->views }}</span>
                                                <span>{{ $item->created_at }}</span>
                                            </p>
                                            <h5 class="font-semibold text-lg/6 mt-3 lg:mt-5">{{ Str::limit($item->title, 28) }}</h5>
                                            <p class="text-base/5 mt-1">{{ Str::limit($item->content, 60) }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-lg relative">
                            <a href="#">
                                <img src="{{ asset('assets/img/add-1.png') }}" alt="" class="relative rounded-lg">
                                <p class="text-blue-primary absolute top-10 left-10 bg-white px-4 py-3 rounded-lg text-center font-semibold text-2xl/6">Наша реклама</p>
                            </a>
                        </div>
                    </div>
                    @else
                        <p>Новостей не найдено</p>
                    @endif
                </div>


            </div>
        </section>
    </main>
@endsection
