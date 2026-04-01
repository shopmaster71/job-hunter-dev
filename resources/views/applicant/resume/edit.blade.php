@extends('layouts.app')
@section('title',  'Кабинет соискателя - Изменение резюме '.$resume->position)
@section('description', 'Изменение резюме '.$resume->position)
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
                            <h2 class="font-semibold text-lg md:text-2xl/6">Изменение резюме "{{ $resume->position }}"</h2>
                        </div>
                        <div class="mt-0">
                            <form action="{{ route('resume.update', ['resume' => $resume->id]) }}" method='POST'>
                                @csrf
                                @method('PUT')
                                <div class="mt-2 md:mt-4 flex flex-col md:flex-row gap-3 md:gap-10">
                                    <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="w-full">
                                            <label class="text-base md:text-lg text-blue-primary">Желаемая должность <sup class="text-red-500">*</sup></label>
                                            <div class="w-full">
                                                <input type="text" name="position" class="w-full block py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                                appearance-none focus:outline-none focus:ring-0 peer" placeholder="Начальник транспортного цеха" value="{{ $resume->position }}" />
                                                @if ($errors->has('position'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('position')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="w-full">
                                            <label class="w-full text-base md:text-lg text-blue-primary">Желаемая зарплата <sup class="text-red-500">*</sup></label>
                                            <div class="w-full">
                                                <input type="text" name="salary" class="input-number block w-full  py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                                appearance-none focus:outline-none focus:ring-0 peer" placeholder="100000" value="{{ $resume->salary }}" />
                                                @if ($errors->has('salary'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('salary')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-8">
                                    <button class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

