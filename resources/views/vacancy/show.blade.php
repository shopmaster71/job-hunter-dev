@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')
@section('title',  'Вакансия: '.$vacancy->position.', '.$vacancy->city_name)
@section('description', 'Вакансия: '.$vacancy->position.', '.$vacancy->city_name)
@section('body_class', 'bg-white')
@section('assets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .favourites-link svg{
            fill: white;
        }

        .favourites-link.active svg {
            fill: #27A746;
        }
    </style>
@endsection
@section('content')
    <main class="main grow">
        <section class="">
            <div class="container mx-auto ">
                <h1 class="text-xl md:text-3xl lg:text-[40px] font-bold">{{ $vacancy->position }}</h1>
                <span class="published-date text-[#53575C] mt-2 md:mt-4 inline-block">{{ $vacancy->publishedAtFormatted }}</span>
                <div class="flex flex-col md:flex-row justify-between gap-6 mt-3 md:mt-6">
                    <div class="w-full md:w-1/2 vacancy-options bg-blue-primary text-white rounded-lg py-8 px-8 relative z-10">
                        <div class="flex flex-row justify-between gap-3 relative z-30">
                            <div class="w-3/4">
                                <dl class="mb-3">
                                    <dt class="text-[#C4C4C4]">Зарплата</dt>
                                    <dd class="font-bold text-lg sm:text-2xl">
                                        @if($vacancy->salary_min)
                                            <span class="diviger @if(!$vacancy->salary_max) ruble @endif">{{ $vacancy->salary_min }}</span> @if($vacancy->salary_max)- <span class="diviger ruble">{{ $vacancy->salary_max }}</span> @endif
                                        @else
                                            <span class="">По договорённости</span>
                                        @endif
                                    </dd>
                                </dl>
                                <dl class="mb-3">
                                    <dt class="text-[#C4C4C4]">Занятость</dt>
                                    <dd class="font-semibold text-base sm:text-lg/6">{{ $vacancy->getEmploymentType->title }}</dd>
                                </dl>
                                <dl class="mb-3">
                                    <dt class="text-[#C4C4C4]">График работы</dt>
                                    <dd class="font-semibold text-base sm:text-lg/6">{{ $vacancy->getSchedule->title }}</dd>
                                </dl>
                                <dl class="mb-3">
                                    <dt class="text-[#C4C4C4]">Требуемый опыт работы</dt>
                                    <dd class="font-semibold text-base sm:text-lg/6">{{ $vacancy->getExpertise->title }}</dd>
                                </dl>
                                <dl class="mb-3">
                                    <dt class="text-[#C4C4C4]">Формат работы</dt>
                                    <dd class="font-semibold text-base sm:text-lg/6">{{ $vacancy->getFormat->title }}</dd>
                                </dl>
                                <div class="w-full mt-5 sm:mt-10">
                                    @if(auth()->user()?->applicant)
                                        <a href="#" rel="response" class="open_popup inline-block grow py-2 px-8 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Откликнуться</a>
                                    @else
                                        <a href="{{ route('login') }}" class="inline-block grow py-2 px-8 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Откликнуться</a>
                                    @endif
                                </div>
                            </div>
                            <div class="w-1/4">
                                <div class="flex flex-row justify-end gap-6">
                                    @if(auth()->user()?->applicant)
                                    <a href="{{ route('favorite.toggle', ['vacancy' => $vacancy->id]) }}"
                                        class="favourites-link {{ $vacancy->is_favorited ? 'active' : '' }}">
                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.7153 0C20.217 0 23.0556 2.88194 23.0556 6.91667C23.0556 14.9861 14.4097 19.5972 11.5278 21.3264C8.64583 19.5972 0 14.9861 0 6.91667C0 2.88194 2.88194 0 6.34028 0C8.48441 0 10.375 1.15278 11.5278 2.30556C12.6806 1.15278 14.5711 0 16.7153 0ZM12.6044 17.9877C13.6206 17.3476 14.5365 16.7101 15.3952 16.027C18.8291 13.295 20.75 10.3099 20.75 6.91667C20.75 4.19699 18.9782 2.30556 16.7153 2.30556C15.475 2.30556 14.1322 2.96161 13.158 3.93583L11.5278 5.56611L9.89752 3.93583C8.92328 2.96161 7.58055 2.30556 6.34028 2.30556C4.10281 2.30556 2.30556 4.21513 2.30556 6.91667C2.30556 10.3099 4.22639 13.295 7.66037 16.027C8.51903 16.7101 9.43491 17.3476 10.4512 17.9877C10.7953 18.2046 11.1371 18.4132 11.5278 18.6464C11.9185 18.4132 12.2603 18.2046 12.6044 17.9877Z"
                                                class="fill-current"/>
                                        </svg>
                                    </a>
                                    @endif
                                    <div class="relative inline-block">
                                        <button id="shareToggle" class="focus:outline-none cursor-pointer">
                                            <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.8191 17.318L7.97871 14.6776C7.13725 15.5769 5.93981 16.1389 4.61111 16.1389C2.06446 16.1389 0 14.0744 0 11.5278C0 8.98113 2.06446 6.91667 4.61111 6.91667C5.93974 6.91667 7.13714 7.4786 7.97858 8.37777L12.8191 5.73752C12.7286 5.37703 12.6806 4.99968 12.6806 4.61111C12.6806 2.06446 14.7451 0 17.2917 0C19.8383 0 21.9028 2.06446 21.9028 4.61111C21.9028 7.15776 19.8383 9.22222 17.2917 9.22222C15.963 9.22222 14.7656 8.66025 13.9241 7.76103L9.08362 10.4013C9.17415 10.7618 9.22222 11.1392 9.22222 11.5278C9.22222 11.9164 9.17416 12.2937 9.08367 12.6542L13.9242 15.2945C14.7656 14.3953 15.963 13.8333 17.2917 13.8333C19.8383 13.8333 21.9028 15.8978 21.9028 18.4444C21.9028 20.991 19.8383 23.0556 17.2917 23.0556C14.7451 23.0556 12.6806 20.991 12.6806 18.4444C12.6806 18.0558 12.7286 17.6784 12.8191 17.318ZM4.61111 13.8333C5.88444 13.8333 6.91667 12.8011 6.91667 11.5278C6.91667 10.2544 5.88444 9.22222 4.61111 9.22222C3.33779 9.22222 2.30556 10.2544 2.30556 11.5278C2.30556 12.8011 3.33779 13.8333 4.61111 13.8333ZM17.2917 6.91667C18.565 6.91667 19.5972 5.88444 19.5972 4.61111C19.5972 3.33779 18.565 2.30556 17.2917 2.30556C16.0183 2.30556 14.9861 3.33779 14.9861 4.61111C14.9861 5.88444 16.0183 6.91667 17.2917 6.91667ZM17.2917 20.75C18.565 20.75 19.5972 19.7178 19.5972 18.4444C19.5972 17.1711 18.565 16.1389 17.2917 16.1389C16.0183 16.1389 14.9861 17.1711 14.9861 18.4444C14.9861 19.7178 16.0183 20.75 17.2917 20.75Z" fill="white"/>
                                            </svg>
                                        </button>
                                        <div id="shareDropdown" class="hidden absolute right-0 top-full mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden z-50">
                                            <a href="#" target="_blank" title="ВКонтакте" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors border-b border-gray-100" style="background-color: #fff">
                                           <svg enable-background="new 0 0 100 100" class="w-5 h-5 mr-3 transition-colors"   version="1.1" viewBox="0 0 100 100"  xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                               <path d="M50,3.84C24.506,3.84,3.84,24.506,3.84,50S24.506,96.16,50,96.16S96.16,75.494,96.16,50S75.494,3.84,50,3.84  z M74.808,67.517c-1.97,1.232-9.975,1.599-11.913,0.191c-1.063-0.772-2.035-1.738-2.958-2.658c-0.646-0.643-1.379-0.955-1.934-1.653  c-0.453-0.571-0.764-1.245-1.241-1.809c-0.805-0.946-2.044-1.751-3.024-0.595c-1.476,1.739,0.232,5.154-1.736,6.453  c-0.66,0.436-1.326,0.562-2.151,0.5l-1.827,0.083c-1.073,0.021-2.773,0.031-3.994-0.189c-1.362-0.246-2.487-0.99-3.719-1.536  c-2.338-1.037-4.565-2.45-6.26-4.407c-4.613-5.33-10.809-12.66-13.216-19.361c-0.495-1.377-1.803-4.104-0.563-5.285  c1.686-1.225,9.961-1.57,11.252,0.324c0.524,0.77,0.855,1.896,1.226,2.769c0.462,1.088,0.712,2.113,1.434,3.076  c0.639,0.854,1.11,1.713,1.604,2.649c0.555,1.051,1.079,2.059,1.754,3.026c0.458,0.658,1.669,1.967,2.434,2.064  c1.868,0.239,1.752-4.3,1.613-5.408c-0.133-1.068-0.167-2.201-0.132-3.284c0.03-0.924,0.113-2.226-0.434-2.98  c-0.892-1.23-2.879-0.31-3.034-1.963c0.328-0.469,0.259-0.885,2.45-1.607c1.726-0.567,2.841-0.549,3.979-0.458  c2.32,0.186,4.78-0.442,7.02,0.31c2.14,0.721,1.809,3.762,1.737,5.584c-0.097,2.487,0.007,4.915,0,7.44  c-0.003,1.149-0.049,2.268,1.353,2.174c1.314-0.087,1.448-1.193,2.075-2.105c0.872-1.272,1.673-2.562,2.561-3.829  c1.197-1.713,1.559-3.638,2.686-5.393c0.403-0.627,0.75-1.963,1.371-2.459c0.47-0.377,1.363-0.18,1.932-0.18h1.353  c1.035,0,2.091-0.008,3.155,0.029c1.532,0.053,3.248-0.299,4.767-0.084c6.555,0.925-8.239,14.938-7.469,17.44  c0.532,1.728,3.907,3.659,5.125,5.074C73.701,61.345,78.679,65.092,74.808,67.517z" fill="#4C75A3"/>
                                           </svg>
                                                <span class="transition-colors" style="color: #4A76A8;">ВКонтакте</span>
                                            </a>
                                            <a href="#" target="_blank" title="Одноклассники" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors border-b border-gray-100" style="background-color: #fff">
                                               <svg class="w-5 h-5 mr-3 transition-colors" data-name="Слой 1" id="Слой_1" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><defs><style>
                                                            .cls-1 {
                                                                fill: #d95d0b;
                                                            }

                                                            .cls-2 {
                                                                fill: #f27b1d;
                                                            }

                                                            .cls-3 {
                                                                fill: none;
                                                                stroke: #fff;
                                                                stroke-linecap: round;
                                                                stroke-linejoin: round;
                                                                stroke-width: 3px;
                                                            }

                                                            .cls-4 {
                                                                fill: #fff;
                                                            }
                                                        </style></defs><title/>
                                                   <path class="cls-1" d="M92,48v.13A44,44,0,1,1,47.87,4H48c1.06,0,2.11,0,3.16.12a42.89,42.89,0,0,1,5.12.67,43.39,43.39,0,0,1,8.1,2.37A44.13,44.13,0,0,1,88.79,31.47a43.22,43.22,0,0,1,2.43,8.24h0a44,44,0,0,1,.67,5.17C92,45.92,92,47,92,48Z"/>
                                                   <path class="cls-2" d="M91,44.5v.12A39.53,39.53,0,1,1,51.38,5h.12c1,0,1.89,0,2.84.11a38.38,38.38,0,0,1,4.59.6,39.33,39.33,0,0,1,5.45,1.45A44.13,44.13,0,0,1,88.79,31.47a38.33,38.33,0,0,1,1.51,5.59h0a39.22,39.22,0,0,1,.6,4.64C91,42.63,91,43.57,91,44.5Z"/>
                                                   <path class="cls-3" d="M74.66,21.93a36.47,36.47,0,0,1,3,3.52"/>
                                                   <path class="cls-3" d="M58,12a38.11,38.11,0,0,1,11.78,5.76"/>
                                                   <g>
                                                       <path class="cls-4" d="M47.87,46.68a9.28,9.28,0,1,1,9.28-9.28A9.29,9.29,0,0,1,47.87,46.68Zm0-14.06a4.78,4.78,0,1,0,4.78,4.78A4.79,4.79,0,0,0,47.87,32.62Z"/>
                                                       <path class="cls-4" d="M60.53,49a2.62,2.62,0,0,0-3.59-.95,17.13,17.13,0,0,1-9,2.72,18.3,18.3,0,0,1-9-2.7,2.63,2.63,0,0,0-2.55,4.59,30,30,0,0,0,4.66,2.13,19.48,19.48,0,0,1,2.11.87l.86.43-6.27,7.58a2.59,2.59,0,0,0,0,3.45A2.5,2.5,0,0,0,41.58,67l6.29-7.6,6.3,7.6a2.5,2.5,0,0,0,3.46.37,2.63,2.63,0,0,0,.28-3.69L51.59,56l.27-.13a13.52,13.52,0,0,1,2-.72,26.2,26.2,0,0,0,5.77-2.57A2.63,2.63,0,0,0,60.8,51,2.57,2.57,0,0,0,60.53,49Z"/>
                                                   </g>
                                               </svg>
                                                <span class="transition-colors" style="color: #F28200;">Одноклассники</span>
                                            </a>
                                            <a href="#" target="_blank" title="Телеграм" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors border-b border-gray-100" style="background-color: #fff">
                                                <svg class="w-5 h-5 mr-3 transition-colors" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="url(#paint0_linear)"/>
                                                    <path d="M8.93822 25.174C11.7438 23.6286 14.8756 22.3388 17.8018 21.0424C22.836 18.919 27.8902 16.8324 32.9954 14.8898C33.9887 14.5588 35.7734 14.2351 35.9484 15.7071C35.8526 17.7907 35.4584 19.8621 35.188 21.9335C34.5017 26.4887 33.7085 31.0283 32.935 35.5685C32.6685 37.0808 30.774 37.8637 29.5618 36.8959C26.6486 34.9281 23.713 32.9795 20.837 30.9661C19.8949 30.0088 20.7685 28.6341 21.6099 27.9505C24.0093 25.5859 26.5539 23.5769 28.8279 21.0901C29.4413 19.6088 27.6289 20.8572 27.0311 21.2397C23.7463 23.5033 20.5419 25.9051 17.0787 27.8945C15.3097 28.8683 13.2479 28.0361 11.4797 27.4927C9.89428 26.8363 7.57106 26.175 8.93806 25.1741L8.93822 25.174Z" fill="white"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear" x1="18.0028" y1="2.0016" x2="6.0028" y2="30" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#37AEE2"/>
                                                            <stop offset="1" stop-color="#1E96C8"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <span class="transition-colors" style="color: #0088cc;">Телеграм</span>
                                            </a>
                                            <a href="#" target="_blank" title="Яндекс" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors border-b border-gray-100" style="background-color: #fff">
                                                <svg class="w-5 h-5 mr-3 transition-colors" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><defs><style>
                                                            .cls-1 {
                                                                fill: #c71c1c;
                                                            }

                                                            .cls-2 {
                                                                fill: #e82c30;
                                                            }

                                                            .cls-3 {
                                                                fill: none;
                                                                stroke: #fff;
                                                                stroke-linecap: round;
                                                                stroke-linejoin: round;
                                                                stroke-width: 3px;
                                                            }

                                                            .cls-4 {
                                                                fill: #fff;
                                                            }
                                                        </style></defs><title/><path class="cls-1" d="M92,48v.13A44,44,0,1,1,47.87,4H48c1.06,0,2.11,0,3.16.12a42.89,42.89,0,0,1,5.12.67,43.39,43.39,0,0,1,8.1,2.37A44.13,44.13,0,0,1,88.79,31.47a43.22,43.22,0,0,1,2.43,8.24h0a44,44,0,0,1,.67,5.17C92,45.92,92,47,92,48Z"/><path class="cls-2" d="M91,44.5v.12A39.53,39.53,0,1,1,51.38,5h.12c1,0,1.89,0,2.84.11a38.38,38.38,0,0,1,4.59.6,39.33,39.33,0,0,1,5.45,1.45A44.13,44.13,0,0,1,88.79,31.47a38.33,38.33,0,0,1,1.51,5.59h0a39.22,39.22,0,0,1,.6,4.64C91,42.63,91,43.57,91,44.5Z"/><path class="cls-3" d="M74.66,21.93a36.47,36.47,0,0,1,3,3.52"/><path class="cls-3" d="M58,12a38.11,38.11,0,0,1,11.78,5.76"/><path class="cls-4" d="M53.38,28.36C49.9,28.24,40,28.93,40,40.87c0,7.06,3.21,10.15,6.49,11.47L38.85,66.72a.52.52,0,0,0,.45.75l3.79,0a.53.53,0,0,0,.46-.28l7.28-14a15.52,15.52,0,0,0,2.42-.07v14a.51.51,0,0,0,.51.51H56.7a.51.51,0,0,0,.51-.51V28.87a.51.51,0,0,0-.51-.51ZM44.25,41.05c0-10.15,7.2-9.7,9-9.43V49.86C50.18,50.17,44.25,49.65,44.25,41.05Z"/></svg>

                                                <span class="transition-colors" style="color: #ff0000;">Яндекс</span>
                                            </a>
                                            <a href="#" target="_blank" title="ЖЖ" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors border-b border-gray-100" style="background-color: #fff">
                                                <svg enable-background="new 0 0 512 512" class="w-5 h-5 mr-3 transition-colors"  viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="livejournal"><g>
                                                            <path d="M511.994,256c0,141.387-114.607,255.996-255.996,255.996C114.613,511.988,0.006,397.387,0.006,256    c0-141.381,114.607-255.996,255.992-255.996C397.387,0.012,511.994,114.619,511.994,256z" fill="#00659B"/><path d="M136.828,181.656l121.787,193.561l110.436,110.467c51.953-25.609,93.944-68.32,118.646-120.795    L236.795,113.986l-66.279,13.688L136.828,181.656z" opacity="0.15"/></g><path d="M370.082,290.811l-0.039,0.016L240.1,117.502l-0.016,0.016   c-7.188-8.875-18.616-13.227-31.796-13.227c-16.023,0-34.593,6.43-51.202,19.023c-30.32,22.951-42.832,57.834-28.43,78.592   l-0.016,0.016L258.584,375.24l0.031-0.023l111.709,32.482L370.082,290.811z M332.599,357.365c-4.297,3.258-7.148,7.727-8.461,12.57   l-47.702-13.875c11.461-17.547,15.234-39.141,10.57-59.484c18.164,10.117,39.851,12.438,59.819,6.172l0.125,49.914   C341.95,352.592,336.896,354.1,332.599,357.365z M232.912,146.773l12.227,16.32c-14.281,1.547-29.983,7.813-44.241,18.609   c-14.296,10.828-24.632,24.297-30.054,37.68l-12.203-16.305c0.445-2.063,1.016-3.914,1.531-5.453   c2.094-6,5.391-11.961,9.781-17.773c4.664-6.188,10.391-11.836,16.945-16.82c6.554-4.961,13.538-8.906,20.741-11.719   c6.758-2.648,13.391-4.188,19.702-4.539C228.951,146.68,230.842,146.641,232.912,146.773z M273.615,267.732l-59.421-79.264   c4.945-3.219,10.093-5.875,15.366-7.938c6.742-2.641,13.391-4.164,19.703-4.555c1.594-0.07,3.484-0.094,5.563,0.023l86.054,114.764   c-8.227,2.266-16.891,2.859-25.577,1.641C298.584,290.029,283.787,281.271,273.615,267.732z M180.547,232.313   c0.445-2.063,1.016-3.906,1.539-5.445c2.109-5.992,5.383-11.984,9.797-17.789c3.405-4.531,7.382-8.766,11.812-12.656l59.405,79.264   l-0.016,0.016c10.164,13.531,14.477,30.25,12.125,47.047c-1.219,8.766-4.203,16.992-8.625,24.297L180.547,232.313z    M171.086,141.977c6.273-4.742,12.922-8.43,19.758-10.93c6.069-2.203,12.108-3.365,17.444-3.365c6.367,0,11.383,1.662,13.742,4.592   l1.203,1.57c-14.281,1.578-29.984,7.836-44.241,18.633c-14.297,10.82-24.633,24.297-30.039,37.688l-1.219-1.633   C142.383,180.828,148.805,158.844,171.086,141.977z" fill="#F4F6F9" id="Livejournal_1_"/></g></svg>
                                                <span class="transition-colors" style="color: #00659B;">ЖЖ</span>
                                            </a>
                                            <a href="#" target="_blank" title="Mail.ru" class="flex items-center px-4 py-3 text-gray-800 hover:text-white transition-colors" style="background-color: #fff">
                                                <svg class="w-5 h-5 mr-3 transition-colors" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24Z" fill="#005FF9"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 23.9603C10 16.2625 16.2802 10 23.9998 10C31.7194 10 37.9997 16.2625 37.9997 23.9603C37.9997 25.0508 37.9087 25.9336 37.7048 26.8197L37.7018 26.8344C37.7013 26.837 37.6001 27.2455 37.5442 27.4237C37.1982 28.5272 36.5718 29.4463 35.7325 30.0815C34.9186 30.6977 33.9094 31.0371 32.891 31.0371C32.7652 31.0371 32.6385 31.032 32.5144 31.0221C31.0682 30.9063 29.7966 30.1474 29.0168 28.9373C27.6757 30.282 25.8964 31.0218 23.9998 31.0218C20.0951 31.0218 16.9184 27.854 16.9184 23.9603C16.9184 20.0666 20.0951 16.8989 23.9998 16.8989C27.9045 16.8989 31.0812 20.0666 31.0812 23.9603V26.2366C31.087 27.5648 31.9808 28.1077 32.7444 28.1691C33.5041 28.2276 34.5152 27.7863 34.8674 26.3461C35.0411 25.5562 35.1294 24.7533 35.1294 23.9603C35.1294 17.8407 30.1367 12.8621 23.9998 12.8621C17.8629 12.8621 12.8703 17.8407 12.8703 23.9603C12.8703 30.0798 17.8629 35.0585 23.9998 35.0585C26.136 35.0585 28.2136 34.4501 30.0079 33.2991L30.0401 33.2784L31.9261 35.465L31.8856 35.4926C29.5549 37.0811 26.828 37.9207 23.9998 37.9207C16.2802 37.9207 10 31.6581 10 23.9603ZM23.9998 28.1596C26.3218 28.1596 28.2109 26.2758 28.2109 23.9603C28.2109 21.6448 26.3218 19.7612 23.9998 19.7612C21.6777 19.7612 19.7887 21.6448 19.7887 23.9603C19.7887 26.2758 21.6777 28.1596 23.9998 28.1596Z" fill="#FF9E00"/>
                                                </svg>
                                                {{--<svg class="w-5 h-5 mr-3 transition-colors" viewBox="0 0 24 24" fill="currentColor" style="color: #e63a27;">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15H9v-4H7V9h2V7c0-1.66 1.34-3 3-3s3 1.34 3 3v2h1v2h-1v2h-2v4z"/>
                                                </svg>--}}
                                                <span class="transition-colors" style="color: #005FF9;">Mail.ru</span>
                                            </a>
                                        </div>
                                        <script>
                                            document.getElementById("shareToggle").addEventListener("click", function (e) {
                                                e.preventDefault();
                                                const dropdown = document.getElementById("shareDropdown");
                                                dropdown.classList.toggle("hidden");
                                                if (!dropdown.classList.contains("hidden")) {
                                                    const currentUrl = encodeURIComponent(window.location.href);
                                                    const title = encodeURIComponent(document.title);
                                                    dropdown.querySelector('[title="ВКонтакте"]').href = `https://vk.com/share.php?url=${currentUrl}`;
                                                    dropdown.querySelector('[title="Одноклассники"]').href = `https://connect.ok.ru/offer?url=${currentUrl}`;
                                                    dropdown.querySelector('[title="Телеграм"]').href = `https://t.me/share/url?url=${currentUrl}`;
                                                    dropdown.querySelector('[title="Яндекс"]').href = `https://yandex.ru/share?url=${currentUrl}`;
                                                    dropdown.querySelector('[title="ЖЖ"]').href = `https://livejournal.com/update.bml?event=${currentUrl}&subject=${title}`;
                                                    dropdown.querySelector('[title="Mail.ru"]').href = `https://mail.ru/?link=${currentUrl}`;
                                                }
                                            });

                                            document.addEventListener("click", function (e) {
                                                const toggle = document.getElementById("shareToggle");
                                                const dropdown = document.getElementById("shareDropdown");
                                                if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                                                    dropdown.classList.add("hidden");
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <h2 class="text-lg sm:text-2xl/6 font-bold">{{ $author->title }}</h2>
                        <div class="flex flex-row gap-3 justify-start items-center mt-2 sm:mt-4">
                            <div class="flex flex-row gap-1 justify-start">
                                <span>
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4127 17.76L4.35926 21.7082L5.93459 13.7799L0 8.2918L8.02704 7.34006L11.4127 0L14.7983 7.34006L22.8253 8.2918L16.8908 13.7799L18.4661 21.7082L11.4127 17.76Z" fill="#27A746"/>
                                    </svg>
                                </span>
                                <span>
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4127 17.76L4.35926 21.7082L5.93459 13.7799L0 8.2918L8.02704 7.34006L11.4127 0L14.7983 7.34006L22.8253 8.2918L16.8908 13.7799L18.4661 21.7082L11.4127 17.76Z" fill="#27A746"/>
                                    </svg>
                                </span>
                                <span>
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4127 17.76L4.35926 21.7082L5.93459 13.7799L0 8.2918L8.02704 7.34006L11.4127 0L14.7983 7.34006L22.8253 8.2918L16.8908 13.7799L18.4661 21.7082L11.4127 17.76Z" fill="#27A746"/>
                                    </svg>
                                </span>
                                <span>
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4127 17.76L4.35926 21.7082L5.93459 13.7799L0 8.2918L8.02704 7.34006L11.4127 0L14.7983 7.34006L22.8253 8.2918L16.8908 13.7799L18.4661 21.7082L11.4127 17.76Z" fill="#27A746"/>
                                    </svg>
                                </span>
                                <span>
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4127 17.76L4.35926 21.7082L5.93459 13.7799L0 8.2918L8.02704 7.34006L11.4127 0L14.7983 7.34006L22.8253 8.2918L16.8908 13.7799L18.4661 21.7082L11.4127 17.76Z" fill="#27A746"/>
                                    </svg>
                                </span>
                            </div>
                            <span class="text-lg">9 отзывов</span>
                        </div>
                        <div class="vacancy-map relative text-blue-primary text-base sm:text-lg pl-7 my-3 sm:my-7">{{ $author->city_name }}, {{ $author->address }}</div>
                        <div id="map" class="w-full h-[300px]"></div>
                        <script src="https://api-maps.yandex.ru/2.1/?apikey=ab81c89f-2e8d-4bb4-92e5-2be77d7dd488&lang=ru_RU"></script>
                        <script type="text/javascript">
                            ymaps.ready(init);
                            function init() {
                                var myMap = new ymaps.Map("map", {
                                    center: [55.76, 37.64],
                                    zoom: 14,
                                    controls: []
                                }, {
                                    searchControlProvider: 'yandex#search'
                                });
                                ymaps.geocode("{{ $vacancy->city_name }}, {{ $vacancy->address }}").then(function (res) {
                                    var coord = res.geoObjects.get(0).geometry.getCoordinates();
                                    var myPlacemark = new ymaps.Placemark(coord, {
                                        balloonContentHeader: '{{ $author->title }}',
                                        balloonContentBody: "{{ $author->city_name }}, {{ $author->address }}",

                                    });
                                    myMap.geoObjects.add(myPlacemark);
                                    myMap.setCenter(coord, 13);
                                });
                            }
                        </script>
                    </div>
                </div>
                <div class="flex flex-col gap-3 md:gap-6 mt-10 md:mt-20">
                    <div class="border border-solid border-[#cccccc] rounded-lg flex flex-col md:flex-row justify-start">
                        <div class="w-full md:w-4/12 px-4 sm:px-8 py-2 sm:py-4 border-b md:border-r border-solid border-[#cccccc]">
                            <h3 class="text-blue-primary font-semibold text-lg sm:text-2xl mb-2"><span class="pb-0.5 sm:pb-1.5 border-b-2 border-solid border-b-green-primary">Обязанности</span></h3>
                            <img src="{{ asset('assets/img/tablet-with-checkboxes.png') }}" class="mt-4 hidden sm:block" alt="Обязанности" />
                        </div>
                        <div class="w-full md:w-8/12 px-4 sm:px-8 py-3 sm:py-6">
                            <p class="text-base/4 sm:text-lg">{{ $vacancy->charge }}</p>
                        </div>
                    </div>
                    @if($vacancy->requirement)
                        <div class="border border-solid border-[#cccccc] rounded-lg flex flex-col md:flex-row justify-start">
                            <div class="w-full md:w-4/12 px-4 sm:px-8 py-2 sm:py-4 border-b md:border-r border-solid border-[#cccccc]">
                                <h3 class="font-semibold text-lg sm:text-2xl mb-2"><span class="pb-0.5 sm:pb-1.5 border-b-2 border-solid border-b-green-primary">Требования</span></h3>
                                <img src="{{ asset('assets/img/isometric.png') }}" class="mt-4 hidden sm:block" alt="Требования" />
                            </div>
                            <div class="w-full md:w-8/12 px-4 sm:px-8 py-3 sm:py-6">
                                <p class="text-base/4 sm:text-lg">{{ $vacancy->requirement }}</p>
                            </div>
                        </div>
                    @endif
                    @if($vacancy->conditions)
                        <div class="border border-solid border-[#cccccc] rounded-lg flex flex-col md:flex-row justify-start">
                            <div class="w-full md:w-4/12 px-4 sm:px-8 py-2 sm:py-4 border-b md:border-r border-solid border-[#cccccc]">
                                <h3 class="font-semibold text-lg sm:text-2xl mb-2"><span class="pb-0.5 sm:pb-1.5 border-b-2 border-solid border-b-green-primary">Условия работы</span></h3>
                                <img src="{{ asset('assets/img/mamager-v.png') }}" class="mt-4 hidden sm:block" alt="Дополнительно" />
                            </div>
                            <div class="w-full md:w-8/12 px-4 sm:px-8 py-3 sm:py-6">
                                <p class="text-base/4 sm:text-lg">{{ $vacancy->conditions }}</p>
                            </div>
                        </div>
                    @endif
                    @if($vacancy->additional)
                        <div class="border border-solid border-[#cccccc] rounded-lg flex flex-col md:flex-row justify-start">
                            <div class="w-full md:w-4/12 px-4 sm:px-8 py-2 sm:py-4 border-b md:border-r border-solid border-[#cccccc]">
                                <h3 class="font-semibold text-lg sm:text-2xl mb-2"><span class="pb-0.5 sm:pb-1.5 border-b-2 border-solid border-b-green-primary">Дополнительно</span></h3>
                                <img src="{{ asset('assets/img/illustration-minimal.png') }}" class="mt-4 hidden sm:block" alt="">
                            </div>
                            <div class="w-full md:w-8/12 px-4 sm:px-8 py-3 sm:py-6">
                                <ul class="vacancy-list-image list-none">
                                    @if(in_array('disabilities', $vacancy->additional))
                                        <li class="text-base/4 sm:text-lg last:mb-0 mb-1.5 last:sm:mb-0 sm:mb-3">Для людей с инвалидностью</li>
                                    @endif
                                        @if(in_array('moving', $vacancy->additional))
                                            <li class="text-base/4 sm:text-lg last:mb-0 mb-1.5 last:sm:mb-0 sm:mb-3">С переездом</li>
                                        @endif
                                        @if(in_array('students', $vacancy->additional))
                                            <li class="text-base/4 sm:text-lg last:mb-0 mb-1.5 last:sm:mb-0 sm:mb-3">Можно студентам</li>
                                        @endif
                                        @if(in_array('pensioners', $vacancy->additional))
                                            <li class="text-base/4 sm:text-lg last:mb-0 mb-1.5 last:sm:mb-0 sm:mb-3">Можно пенсионерам</li>
                                        @endif
                                        @if(in_array('phone', $vacancy->additional))
                                            <li class="text-base/4 sm:text-lg last:mb-0 mb-1.5 last:sm:mb-0 sm:mb-3">Работа с телефоном</li>
                                        @endif

                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-4 sm:mt-15 w-full sm:w-2/3">
                    <h4 class="font-semibold text-lg sm:text-2xl mb-0 sm:mb-4">{{ $author->title }}</h4>
                    <p class="text-base sm:text-lg mb-1.5 sm:mb-3">{{ $author->about ?: $author->getInformation->about }}</p>
                </div>
                @if(isset($author->gallery))
                    <div class="flex flex-col sm:flex-row justify-start gap-3 sm:gap-6 mt-5 sm:mt-10 w-full">
                        @foreach(json_decode($author->gallery) as $item)
                            <div class="w-full sm:w-1/3">
                                <img src="{{ asset($item) }}" class="rounded-lg" alt="" />
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(count($similar))
                    <div class="mt-10 sm:mt-14">
                        <h2 class="font-bold text-2xl sm:text-[40px]">Похожие вакансии</h2>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                            @foreach($similar as $item)
                                <div class="bg-[#F5F6F8] px-4 py-3 rounded-lg">
                                    <div class="flex flex-row justify-between items-start gap-1 sm:gap-3">
                                        <div class="vacancy-card-header">
                                            <h4 class="truncate font-semibold text-lg/5">{{ $item->position }}</h4>
                                            <p class="text-[#53575C] mt-1">{{ $item->organization }} </p>
                                            <p class="font-bold text-xl/5 mt-2">
                                                @if($item->salary_min)
                                                    <span class="diviger @if(!$item->salary_max) ruble @endif">{{ $item->salary_min }}</span> @if($item->salary_max)- <span class="diviger ruble">{{ $item->salary_max }}</span> @endif
                                                @else
                                                    <span class="">По договорённости</span>
                                                @endif
                                            </p>
                                        </div>
                                        @if(auth()->user()?->role == 1)
                                            <div class="">
                                                <a href="{{ route('favorite.toggle', ['vacancy' => $vacancy->id]) }}" class="favourites-link {{ $vacancy->is_favorited ? 'active' : '' }}"><span></span></a>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-base/5 my-3">{{ Str::limit($item->charge, 100)  }}</p>
                                    <p class="flex flex-col lg:flex-row justify-between items-start gap-1 lg:gap-3">
                                        <span class="text-lg/6 max-w-full lg:max-w-7/12">{{ $item->city_name }}, {{ $item->address }}</span>
                                        <span class="text-sm text-[#53575C]">{{ $item->publishedAtFormatted }}</span>
                                    </p>
                                    <div class="mt-6 mb-3">
                                        <a href="{{ route('vacancy.show', ['slug' => $item->slug]) }}" class="btn-utp-green inline-block grow py-2.5 px-10 text-white text-base/6 bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Подробнее</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
    @if(auth()->user()?->applicant)
        <div class="popup popup-primary response w-[352px] -ml-44 sm:w-[600px] sm:ml-[-300px]">
            <div class="popup_header py-2 relative">
                <h3 class="text-2xl text-blue-primary font-medium">Отклик на вакансию</h3>
                <div class="close_popup"></div>
            </div>
            <div class="popup_body">
                <form action="{{ route('response.store',['vacancy' => $vacancy->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <span class="text-blue-primary font-medium text-xl">{{ $vacancy->position }}</span>
                    <div class="w-full mt-4">
                        <button type="button" id="generate-cover-letter" class="text-green-primary text-sm mb-2">✨ Сгенерировать сопроводительное письмо</button>
                        <textarea name="resp" rows="5" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" id="cover-letter" placeholder="Сопроводительное письмо">{{ old('resp') }}</textarea>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between items-center gap-3 mt-3">
                        <div class="inline-flex flex-col items-start">
                            <label id="file-label" class="inline-flex items-center pr-2 font-medium text-lg text-[#8F8F8F] focus:outline-none cursor-pointer ">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8287 7.7574L9.1718 13.4142C8.78127 13.8047 8.78127 14.4379 9.1718 14.8284C9.56232 15.219 10.1955 15.219 10.586 14.8284L16.2429 9.17161C17.4144 8.00004 17.4144 6.10055 16.2429 4.92897C15.0713 3.7574 13.1718 3.7574 12.0002 4.92897L6.34337 10.5858C4.39075 12.5384 4.39075 15.7042 6.34337 17.6569C8.29599 19.6095 11.4618 19.6095 13.4144 17.6569L19.0713 12L20.4855 13.4142L14.8287 19.0711C12.095 21.8047 7.66283 21.8047 4.92916 19.0711C2.19549 16.3374 2.19549 11.9053 4.92916 9.17161L10.586 3.51476C12.5386 1.56214 15.7045 1.56214 17.6571 3.51476C19.6097 5.46738 19.6097 8.6332 17.6571 10.5858L12.0002 16.2427C10.8287 17.4142 8.92916 17.4142 7.75759 16.2427C6.58601 15.0711 6.58601 13.1716 7.75759 12L13.4144 6.34319L14.8287 7.7574Z" fill="#0B2641"/>
                                </svg>
                                Прикрепить резюме
                                <input type="file" name="resume" id="file-input" class="hidden" accept=".pdf,.doc,.docx" />
                            </label>
                            <span id="file-name" class="mt-2 text-sm text-gray-600 hidden"></span>
                        </div>
                        <button class="py-2 px-10 text-white disabled:text-[#8F8F8F] text-base bg-green-primary disabled:bg-[#cccccc] border border-solid disabled:border-[#cccccc] border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Откликнуться</button>
                    </div>
                    <script>
                        document.getElementById('file-input').addEventListener('change', function () {
                            const fileName = this.files[0]?.name || '';
                            const fileNameSpan = document.getElementById('file-name');
                            if (fileName) {
                                fileNameSpan.textContent = 'Выбрано: ' + fileName;
                                fileNameSpan.classList.remove('hidden');
                            } else {
                                fileNameSpan.classList.add('hidden');
                            }
                        });
                    </script>
                </form>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        document.getElementById('generate-cover-letter')?.addEventListener('click', async function () {
            const button = this;
            const textarea = document.getElementById('cover-letter');
            button.disabled = true;
            button.textContent = 'Генерируем...';

            try {
                const response = await fetch('{{ route("ai.cover-letter.generate") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        job_title: @json($vacancy->position),
                        company_name: @json($author->title),
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(`HTTP ${response.status}: ${errorData.error || 'Unknown error'}`);
                }

                const data = await response.json();

                if (data.success && data.letter) {
                    textarea.value = data.letter;
                } else {
                    textarea.value = 'Ошибка: ' + (data.error || 'Неизвестная ошибка');
                }
            } catch (error) {
                console.error('AI Cover Letter Error:', error);
                textarea.value = 'Ошибка: ' + error.message;
            } finally {
                button.disabled = false;
                button.textContent = '✨ Сгенерировать сопроводительное письмо';
            }
        });
    </script>
@endpush




