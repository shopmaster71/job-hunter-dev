@extends('layouts.app')
@section('title',  'Кабинет HR-менеджера - Изменение личной информации')
@section('description', 'Изменение личной информации')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow">
        <section>
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Личный кабинет</h1>
                        <div class="subscribe mt-3 lg:mt-6">
                            <h5 class="font-semibold text-lg lg:text-2xl">Закажите продвижение Вашего профиля</h5>
                            <ul class="text-base lg:text-lg list-disc list-inside mt-2 lg:mt-6">
                                <li>Размещение на главной странице</li>
                                <li>Поднятие профиля на странице поиска</li>
                            </ul>
                            <div class="w-full mt-4 lg:mt-9 py-3">
                                <a href="#" class="btn-utp-green inline w-full grow py-3 px-6 text-white text-base:text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Заказать продвижение</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-hr-component />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение личной информации</h2>
                            <form action="{{ route('hr.update', ['hr' => $hr->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Фамилия <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="surname" class="block py-1 w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Фамилия" value="{{ $hr->surname }}" />
                                                @if ($errors->has('surname'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('surname')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Имя <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="name" class="block py-1 w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Имя" value="{{ $hr->name }}" />
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('name')[0] }}</div>
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
        </section>
    </main>
@endsection


