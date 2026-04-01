@extends('layouts.app')
@section('title',  'Изменение профессиональной информации')
@section('description', 'Изменение профессиональной информации')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white h-full rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Личный кабинет</h1>
                        <div class="subscribe mt-3 lg:mt-6">
                            <h5 class="font-semibold text-lg lg:text-2xl">Закажите продвижение Вашего агентства</h5>
                            <ul class="text-base lg:text-lg list-disc list-inside mt-2 lg:mt-6">
                                <li>Размещение на главной странице</li>
                                <li>Поднятие профиля на странице поиска</li>
                                <li>?Рекомендация профиля соискателям?</li>
                            </ul>
                            <div class="w-full mt-4 lg:mt-9 py-3">
                                <a href="#" class="btn-utp-green inline w-full grow py-3 px-6 text-white text-base:text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Заказать продвижение</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-agency-component />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение профессиональной информации</h2>
                            <form action="{{ route('agency.information.update', ['agency' => $agency->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-6 flex flex-col gap-1 lg:gap-2">
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-5/16 text-base md:text-lg text-blue-primary">Главное преимущество <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-11/16 py-1">
                                        <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                        appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о Вашем главном преимуществе." name="advantage">{{ $agency->getInformation->advantage }}</textarea>
                                            @if ($errors->has('advantage'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('advantage')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-5/16 text-base md:text-lg text-blue-primary">О агентстве<sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-11/16 py-1">
                                        <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                        appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о агенстве, его целях и миссии" name="about" >{{ $agency->getInformation->about }}</textarea>
                                            @if ($errors->has('about'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('about')[0] }}</div>
                                            @endif
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



