@extends('layouts.app')
@section('title',  'Кабинет соискателя - Список образовательных учреждений')
@section('description', 'Список образовательных учреждений')
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
                        <ul class="text-base lg:text-lg list-disc list-inside mt-4 lg:mt-9">
                            <li>Откликов на вакансии <b>– 10</b></li>
                            <li>Откликов от работодателей <b>– 20</b></li>
                            <li>Создано резюме <b>– 5</b></li>
                        </ul>
                    </div>
                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-applicant-component />
                    </div>


                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <div class="flex flex-row justify-between gap-3">
                            <h2 class="font-semibold text-lg md:text-2xl/6">Список образовательных учреждений</h2>
                            <div class="">
                                <a href="{{ route('education.create') }}" class="inline-block grow py-0 md:py-3 px-0 md:px-12 text-green-primary md:text-white text-base md:text-lg bg-transparent md:bg-green-primary border-none md:border md:border-solid border-green-primary rounded-full  hover:border-transparent md:hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out"><span class="hidden md:inline">Добавить</span><span class="inline md:hidden text-3xl/5 font-bold">+</span></a>
                            </div>
                        </div>
                        <div class="mt-0">
                            @if(count($educations))
                                @foreach($educations as $education)
                                    <div class="relative mt-2 md:mt-5 pt-1 pb-3 md:pb-8 last:border-0 border-b border-b-[#cccccc]">
                                        <dl class="">
                                            <dt class="text-lg md:text-xl">Название учреждения: <b>{{ $education->institution }}</b></dt>
                                            <dd class="mt-1 md:mt-2">Город: <b>{{ $education->city }}</b></dd>
                                            @if($education->faculty)
                                                <dd class="mt-1 md:mt-2">Факультет: <b>{{ $education->faculty }}</b></dd>
                                            @endif
                                            @if($education->specialization)
                                                <dd class="mt-1 md:mt-2">Специализация: <b>{{ $education->specialization }}</b></dd>
                                            @endif
                                            <dd class="mt-1 md:mt-2">Период обучения: <b>{{  $education->period_start }} - {{  $education->present ? 'по настоящее время':  $education->period_end}}</b></dd>
                                        </dl>
                                        <a href="{{ route('education.edit', ['education' =>  $education->id]) }}" class="text-gray-500 hover:text-green-primary transition block absolute top-0 right-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.7279 9.57628L14.3137 8.16207L5 17.4758V18.89H6.41421L15.7279 9.57628ZM17.1421 8.16207L18.5563 6.74786L17.1421 5.33364L15.7279 6.74786L17.1421 8.16207ZM7.24264 20.89H3V16.6473L16.435 3.21232C16.8256 2.8218 17.4587 2.8218 17.8492 3.21232L20.6777 6.04075C21.0682 6.43127 21.0682 7.06444 20.6777 7.45496L7.24264 20.89Z" fill="currentColor"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <p>Образовательные учреждения ещё не добавлены</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


