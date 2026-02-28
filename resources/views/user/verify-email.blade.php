@extends('layouts.app-login')
@section('title',  'Подтверждение email')
@section('content')
    <div class="h-full w-full lg:w-1/2 flex justify-center lg:justify-start items-center bg-white py-3 lg:py-0 pl-3 lg:pl-30 pr-3 lg:pr-5">
        <div class="w-full max-w-[408px]">
            <h2 class="font-semibold text-xl md:text-2xl lg:text-3xl">Подтверждение E-mail</h2>
            <p class="mt-1 lg:mt-3">Спасибо за регистрацию на сайте job-hunter.ru<br/> На ваш E-mail отправлена ссылка для подтверждения e-mail адреса.</p>
            <div class="mt-3 lg:mt-13">
                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <p class="mb-3 text-lg">Не пришла ссылка?</p>
                    <div class="w-full lg:w-5/8 mt-5 lg:mt-12">
                        <button class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Отправить запрос</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


