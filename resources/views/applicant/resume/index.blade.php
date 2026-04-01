@extends('layouts.app')
@section('title',  'Кабинет соискателя - Список резюме')
@section('description', 'Список Список резюме')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow">
        <section>
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Личный кабинет соискателя</h1>
                        <div class="subscribe mt-3 lg:mt-6">
                            <h5 class="font-semibold text-lg lg:text-2xl">Оформите подписку</h5>
                            <ul class="text-base lg:text-lg list-disc list-inside mt-2 lg:mt-6">
                                <li>Первым узнаете о вакансии</li>
                                <li>Повысит  эффективность поиска работы на 50%</li>
                            </ul>
                            <div class="w-full mt-4 lg:mt-9 py-3">
                                <a href="#" class="btn-utp-green inline w-full grow py-3 px-6 text-white text-base:text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Оформить подписку</a>
                            </div>
                        </div>
                        <x-counts-applicant />
                    </div>
                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-applicant-component />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <div class="flex flex-row justify-between gap-3">
                            <h2 class="font-semibold text-lg md:text-2xl/6">Список резюме</h2>
                            <div class="">
                                <a href="{{ route('resume.create') }}" class="inline-block grow py-0 md:py-3 px-0 md:px-12 text-green-primary md:text-white text-base md:text-lg bg-transparent md:bg-green-primary border-none md:border md:border-solid border-green-primary rounded-full  hover:border-transparent md:hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out"><span class="hidden md:inline">Добавить</span><span class="inline md:hidden text-3xl/5 font-bold">+</span></a>
                            </div>
                        </div>
                        <div class="mt-0">

                            <div id="tabs">
                                <ul class="tabs-nav flex flex-row gap-10 md:gap-20 font-semibold text-base md:text-xl text-[#53575C]">
                                    <li><a class="pb-2 border-b border-b-transparent" href="#tab-1">Активные резюме</a></li>
                                    <li><a class="pb-2 border-b border-b-transparent" href="#tab-2">Архив</a></li>
                                </ul>
                                <div class="tabs-items mt-6">
                                    <div class="tabs-item" id="tab-1">
                                        @if($activeResumes->isEmpty())
                                            <p>Активные резюме не найдены</p>
                                        @else
                                        <div class="w-full overflow-x-auto">
                                            <table class="min-w-full table-auto border-separate border-spacing-0 bg-white text-blue-primary">
                                                <thead class="font-semibold text-base md:text-lg">
                                                <tr>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Должность</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">З/п, руб</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Статус</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Дата создания</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300"></th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-base md:text-lg divide-y divide-gray-300">
                                                @foreach($activeResumes as $activeResume)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 border border-gray-300">{{ $activeResume->position }}</td>
                                                        <td class="px-4 py-3 border border-gray-300">
                                                            <span class="diviger">{{ $activeResume->salary }}</span>
                                                        </td>
                                                        <td class="px-4 py-3 border border-gray-300">
                                                            <span class="inline-flex px-2 py-2 font-medium text-green-800 bg-green-100 rounded-full">Активно</span>
                                                        </td>
                                                        <td class="px-4 py-3 border border-gray-300 text-gray-800">{{ $activeResume->created_at }}</td>
                                                        <td class="px-4 py-3 border border-gray-300 text-right">
                                                            <div class="flex justify-around space-x-3 items-center">
                                                                <a href="{{ route('resume.edit', ['resume' => $activeResume->id]) }}" class="text-gray-500 hover:text-green-primary transition">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.7279 9.57628L14.3137 8.16207L5 17.4758V18.89H6.41421L15.7279 9.57628ZM17.1421 8.16207L18.5563 6.74786L17.1421 5.33364L15.7279 6.74786L17.1421 8.16207ZM7.24264 20.89H3V16.6473L16.435 3.21232C16.8256 2.8218 17.4587 2.8218 17.8492 3.21232L20.6777 6.04075C21.0682 6.43127 21.0682 7.06444 20.6777 7.45496L7.24264 20.89Z" fill="currentColor"/>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ route('resume.show', ['resume' => $activeResume->id]) }}" class="text-gray-500 hover:text-yellow-600 transition">
                                                                    <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M25.7761 8.38456C23.8887 10.3705 22.2373 11.9505 20.2211 13.4128C16.6467 16.0073 12.6524 16.8518 8.38714 15.0143C5.12937 13.6154 2.40959 11.4731 0.353416 8.67654C-0.0145506 8.1776 -0.163641 7.98233 0.239219 7.47107C3.13029 3.79861 6.64691 0.865948 11.5732 0.121848C14.8608 -0.375245 17.8705 0.702099 20.3917 2.59684C22.3584 4.07519 23.9921 5.64654 25.8129 7.55607C26.0603 7.79692 26.0724 8.07596 25.7761 8.38456ZM2.35503 7.5222C2.24037 7.65016 2.1769 7.81388 2.17621 7.98349C2.17551 8.1531 2.23762 8.31731 2.35122 8.44616C4.26147 10.5984 6.42042 12.3632 9.08627 13.4972C10.9775 14.2979 12.9531 14.5875 14.9801 14.0516C18.4694 13.1276 21.0985 11.0148 23.4268 8.42953C23.5335 8.31094 23.5927 8.15898 23.5934 8.0015C23.5941 7.84402 23.5363 7.69157 23.4306 7.57209C21.5102 5.40939 19.3475 3.62984 16.6677 2.48782C13.9878 1.34579 11.334 1.44066 8.6961 2.66152C6.21931 3.80539 4.19549 5.48208 2.35503 7.52404V7.5222Z" fill="currentColor"/>
                                                                        <path d="M12.8313 12.9195C9.98587 12.8992 7.76412 10.6786 7.80726 7.89804C7.84976 5.17912 10.1096 3.04476 12.9252 3.06509C15.7706 3.08541 17.9923 5.30601 17.9485 8.08653C17.9067 10.8055 15.6468 12.9398 12.8313 12.9195ZM12.8598 11.2976C14.6996 11.3093 16.2679 9.80264 16.28 8.01015C16.2921 6.21765 14.7415 4.69866 12.8966 4.68695C11.0517 4.67525 9.48848 6.18193 9.47643 7.97442C9.46438 9.76691 11.0149 11.2859 12.8598 11.2976Z" fill="currentColor"/>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ route('resume.archive', ['resume' => $activeResume->id]) }}" class="text-gray-500 hover:text-red-600 transition">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M20 3L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3H20ZM20 9H4V19H20V9ZM13 10V14H16L12 18L8 14H11V10H13ZM18.7639 5H5.23656L4.23744 7H19.7639L18.7639 5Z" fill="currentColor"/>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ route('resume.download', ['resume' => $activeResume->id]) }}" class="text-gray-500 hover:text-red-600 transition">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="24"
                                                                        height="24"
                                                                        viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                    >
                                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                                        <polyline points="7 10 12 15 17 10" />
                                                                        <line x1="12" y1="15" x2="12" y2="3" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tabs-item" id="tab-2">
                                        @if($archivedResumes->isEmpty())
                                            <p>Архивные резюме не найдены</p>
                                        @else
                                        <div class="w-full overflow-x-auto">
                                            <table class="min-w-full table-auto border-separate border-spacing-0 bg-white text-blue-primary">
                                                <thead class="font-semibold text-base md:text-lg">
                                                <tr>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Должность</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">З/п, руб</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Статус</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300">Дата создания</th>
                                                    <th class="text-left px-4 py-3 border border-gray-300"></th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-base md:text-lg divide-y divide-gray-300">
                                                    @foreach($archivedResumes as $archivedResume)
                                                        <tr class="hover:bg-gray-50">
                                                            <td class="px-4 py-3 border border-gray-300">{{ $archivedResume->position }}</td>
                                                            <td class="px-4 py-3 border border-gray-300">
                                                        <span class="diviger">{{ $archivedResume->salary }}</span>
                                                    </td>
                                                    <td class="px-4 py-3 border border-gray-300">
                                                        <span class="inline-flex px-2 py-2 font-medium text-blue-800 bg-blue-100 rounded-full">Архив</span>
                                                    </td>
                                                    <td class="px-4 py-3 border border-gray-300 text-gray-800">{{ $archivedResume->created_at }}</td>
                                                    <td class="px-4 py-3 border border-gray-300">
                                                        <a href="{{ route('resume.list', ['resume' => $archivedResume->id]) }}">
                                                            <span class="inline-flex px-2 py-2 font-medium text-red-800 bg-red-100 rounded-full">Восстановить</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
