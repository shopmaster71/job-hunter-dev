@extends('layouts.app')
@section('title',  'Список вакансий')
@section('description', 'Список вакансий')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <div class="flex flex-row justify-between gap-3">
                            <h1 class="font-semibold text-lg md:text-3xl">Вакансии</h1>
                            <div class="">
                                <a href="{{ route('agency.vacancy.create') }}" title="Добавить" class="inline-block grow py-0 md:py-3 px-0 md:px-12 text-green-primary md:text-white text-base md:text-lg bg-transparent md:bg-green-primary border-none md:border md:border-solid border-green-primary rounded-full  hover:border-transparent md:hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out"><span class="hidden md:inline">Добавить</span><span class="inline md:hidden text-3xl/5 font-bold">+</span></a>
                            </div>
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
                                                        <a href="{{ route('agency.vacancy.edit', ['vacancy' => $vacancy->id]) }}" class="block p-1 text-gray-400 hover:text-green-primary transition">
                                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.7279 9.57628L14.3137 8.16207L5 17.4758V18.89H6.41421L15.7279 9.57628ZM17.1421 8.16207L18.5563 6.74786L17.1421 5.33364L15.7279 6.74786L17.1421 8.16207ZM7.24264 20.89H3V16.6473L16.435 3.21232C16.8256 2.8218 17.4587 2.8218 17.8492 3.21232L20.6777 6.04075C21.0682 6.43127 21.0682 7.06444 20.6777 7.45496L7.24264 20.89Z" fill="currentColor"/>
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('vacancy.show', ['slug' => $vacancy->slug]) }}" class="block p-1 text-gray-400 hover:text-yellow-600 transition">
                                                            <svg width="22" height="14" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M25.7761 8.38456C23.8887 10.3705 22.2373 11.9505 20.2211 13.4128C16.6467 16.0073 12.6524 16.8518 8.38714 15.0143C5.12937 13.6154 2.40959 11.4731 0.353416 8.67654C-0.0145506 8.1776 -0.163641 7.98233 0.239219 7.47107C3.13029 3.79861 6.64691 0.865948 11.5732 0.121848C14.8608 -0.375245 17.8705 0.702099 20.3917 2.59684C22.3584 4.07519 23.9921 5.64654 25.8129 7.55607C26.0603 7.79692 26.0724 8.07596 25.7761 8.38456ZM2.35503 7.5222C2.24037 7.65016 2.1769 7.81388 2.17621 7.98349C2.17551 8.1531 2.23762 8.31731 2.35122 8.44616C4.26147 10.5984 6.42042 12.3632 9.08627 13.4972C10.9775 14.2979 12.9531 14.5875 14.9801 14.0516C18.4694 13.1276 21.0985 11.0148 23.4268 8.42953C23.5335 8.31094 23.5927 8.15898 23.5934 8.0015C23.5941 7.84402 23.5363 7.69157 23.4306 7.57209C21.5102 5.40939 19.3475 3.62984 16.6677 2.48782C13.9878 1.34579 11.334 1.44066 8.6961 2.66152C6.21931 3.80539 4.19549 5.48208 2.35503 7.52404V7.5222Z" fill="currentColor"/>
                                                                <path d="M12.8313 12.9195C9.98587 12.8992 7.76412 10.6786 7.80726 7.89804C7.84976 5.17912 10.1096 3.04476 12.9252 3.06509C15.7706 3.08541 17.9923 5.30601 17.9485 8.08653C17.9067 10.8055 15.6468 12.9398 12.8313 12.9195ZM12.8598 11.2976C14.6996 11.3093 16.2679 9.80264 16.28 8.01015C16.2921 6.21765 14.7415 4.69866 12.8966 4.68695C11.0517 4.67525 9.48848 6.18193 9.47643 7.97442C9.46438 9.76691 11.0149 11.2859 12.8598 11.2976Z" fill="currentColor"/>
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('vacancy.add.archive', ['slug' => $vacancy->slug]) }}" class="block p-1 text-gray-400 hover:text-red-600 transition">
                                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 3L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3H20ZM20 9H4V19H20V9ZM13 10V14H16L12 18L8 14H11V10H13ZM18.7639 5H5.23656L4.23744 7H19.7639L18.7639 5Z" fill="currentColor"/>
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



