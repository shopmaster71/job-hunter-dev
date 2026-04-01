@extends('layouts.app')
@section('title',  'Кабинет соискателя - Избранное')
@section('description', 'Кабинет соискателя - Избранное')
@section('body_class', 'bg-white')
@section('assets')
    <style>
        .favourites-black-link svg{
            fill: #0B2641;
        }

        .favourites-black-link.active svg {
            fill: #27A746;
        }
    </style>
@endsection
@section('content')
    <main class="main grow">
        <section class="py-3 md:py-0 h-full overflow-hidden">
            <div class="container mx-auto h-full">
                <div class="w-full">
                    <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Избранные вакансии</h1>
                    @if(count($favorites))
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">
                        @foreach($favorites as $favorite)
                            <div class="bg-white py-2">
                                <div class="flex flex-row justify-between items-start gap-1 sm:gap-3">
                                    <div class="vacancy-card-header">
                                        <h4 class="truncate font-semibold text-lg/5">{{ $favorite->vacancy->position }}</h4>
                                        <p class="text-[#53575C] mt-1">{{ $favorite->vacancy->organization }}</p>
                                        <p class="font-bold text-xl/5 mt-2">
                                            @if($favorite->vacancy->salary_min)
                                                <span class="diviger @if(!$favorite->vacancy->salary_max) ruble @endif">{{ $favorite->vacancy->salary_min }}</span> @if($favorite->vacancy->salary_max)- <span class="diviger ruble">{{ $favorite->vacancy->salary_max }}</span> @endif
                                            @else
                                                <span class="">По договорённости</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if(auth()->user()->role == 1)
                                        <div>
                                            <a href="{{ route('favorite.toggle', ['vacancy' => $favorite->vacancy->id]) }}"
                                               class="favourites-black-link {{ $favorite->vacancy->is_favorited ? 'active' : '' }}">
                                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.7153 0C20.217 0 23.0556 2.88194 23.0556 6.91667C23.0556 14.9861 14.4097 19.5972 11.5278 21.3264C8.64583 19.5972 0 14.9861 0 6.91667C0 2.88194 2.88194 0 6.34028 0C8.48441 0 10.375 1.15278 11.5278 2.30556C12.6806 1.15278 14.5711 0 16.7153 0ZM12.6044 17.9877C13.6206 17.3476 14.5365 16.7101 15.3952 16.027C18.8291 13.295 20.75 10.3099 20.75 6.91667C20.75 4.19699 18.9782 2.30556 16.7153 2.30556C15.475 2.30556 14.1322 2.96161 13.158 3.93583L11.5278 5.56611L9.89752 3.93583C8.92328 2.96161 7.58055 2.30556 6.34028 2.30556C4.10281 2.30556 2.30556 4.21513 2.30556 6.91667C2.30556 10.3099 4.22639 13.295 7.66037 16.027C8.51903 16.7101 9.43491 17.3476 10.4512 17.9877C10.7953 18.2046 11.1371 18.4132 11.5278 18.6464C11.9185 18.4132 12.2603 18.2046 12.6044 17.9877Z"
                                                          class="fill-current"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-base/5 my-3">{{ $favorite->vacancy->charge }}</p>
                                <p class="flex flex-col lg:flex-row justify-between items-start gap-1 lg:gap-3">
                                    <span class="text-lg/6 max-w-full lg:max-w-7/12">{{ $favorite->vacancy->city_name }}, {{ $favorite->vacancy->address }}</span>
                                    <span class="text-sm text-[#53575C]">{{ $favorite->vacancy->publishedAtFormatted }}</span>
                                </p>
                                <div class="mt-6 mb-3">
                                    <a href="{{ route('vacancy.show', ['slug' => $favorite->vacancy->slug]) }}" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Подробнее</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="mt-5 pl-0 sm:mt-10 sm:pl-6">
                            {{ $favorites->links() }}
                        </div>
                    </div>
                    @else
                    <p>В избранном ничего нет(</p>
                   @endif
            </div>
        </section>
    </main>

@endsection




