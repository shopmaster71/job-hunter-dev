@extends('layouts.app')
@section('title',  'Вакансии в архиве')
@section('description', 'Вакансии в архиве')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <div class="flex flex-row justify-between gap-3">
                            <h1 class="font-semibold text-lg md:text-3xl">Архив вакансий</h1>
                        </div>
                        @if(count($vacancies))
                        <div class="mt-2 px-0 md:px-1">
                            @foreach($vacancies as $vacancy)
                                <div class=" bg-white  py-3 mt-3 last:border-0 border-b border-[#cccccc]">
                                    <div class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-3">
                                        <div class="w-full sm:w-2/3">
                                            <h4 class="font-semibold text-lg/5">{{ $vacancy->position }}</h4>
                                            <p class="text-[#53575C] mt-1">{{ $vacancy->organization }}</p>
                                        </div>
                                        <div class="flex flex-row justify-between items-start gap-3 sm:gap-3">
                                            <p class="font-bold text-base/4">
                                                @if($vacancy->salary_min)
                                                    <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                                @else
                                                    <span class="">По договорённости</span>
                                                @endif

                                            </p>
                                            <div class="relative">
                                                <!-- Кнопки начало -->
                                                <div class="action-buttons-container mb-1 absolute top-0 -right-0">
                                                    <!-- Кнопка для раскрытия/скрытия -->
                                                    <button type="button" class="toggle-btn transition opacity-50 cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 512 512">
                                                            <circle cx="256" cy="256" r="22"/>
                                                            <circle cx="256" cy="346" r="22"/>
                                                            <circle cx="256" cy="166" r="22"/>
                                                            <path d="M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z" style="fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:26px"/>
                                                        </svg>
                                                    </button>
                                                    <div class="action-buttons hidden flex-col gap-1 absolute top-7 bg-white">
                                                        <a href="{{ route('vacancy.remove.archive', ['slug' => $vacancy->slug]) }}" class="block p-1 text-gray-400 hover:text-red-600 transition">
                                                            <svg width="22" height="22" viewBox="0 0 22 22">
                                                                <path d="M20 21H4V10H6V19H18V10H20V21M3 3H21V9H3V3M5 5V7H19V5M10.5 17V14H8L12 10L16 14H13.5V17" fill="currentColor" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- Кнопки конец -->
                                            </div>

                                        </div>
                                    </div>
                                    <p class="text-base/5 my-3 pr-0 sm:pr-11">{{ $vacancy->charge }}</p>
                                    <p class="flex flex-col sm:flex-row justify-between items-start gap-1 sm:gap-6 pr-0 sm:pr-11">
                                        <span class="text-lg">{{ $vacancy->city_name }}, {{ $vacancy->address }}</span>
                                        <span class="text-sm text-[#53575C]">{{ $vacancy->publishedAtFormatted }}</span>
                                    </p>
                                    <div class="mt-6 mb-3">
                                        <a href="" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Поднять</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $vacancies->links() }}
                        @else
                            <p>Вакансий не найдено</p>
                        @endif
                    </div>

                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-agency-component />


                    </div>
                </div>




            </div>

        </section>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('click', function (e) {
            const toggleBtn = e.target.closest('.toggle-btn');
            if (!toggleBtn) return;

            e.preventDefault();

            const container = toggleBtn.closest('.action-buttons-container');
            const actionButtons = container.querySelector('.action-buttons');
            const icon = toggleBtn.querySelector('svg');

            if (actionButtons.classList.contains('hidden')) {
                actionButtons.classList.remove('hidden');
            } else {
                actionButtons.classList.add('hidden');
            }
        });
    </script>
@endpush



