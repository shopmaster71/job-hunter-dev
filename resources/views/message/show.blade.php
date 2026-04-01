@extends('layouts.app')
@section('title',  'Кабинет соискателя - Сообщение')
@section('description', 'Сообщение')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
<main class="main grow ">
    <section class="">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                    <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">{{ $message->theme }}</h1>
                    <div class="mt-3 lg:mt-6">
                        <div class="flex flex-row justify-between gap-3 border-b border-gray-300 py-3 mb-5">
                            <div>Отправитель: <br/><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
                            @if($message->phone)
                                <div>Телефон: <br/><a href="tel:+{{ preg_replace("/[^0-9]/", "", $message->phone) }}">{{ $message->phone }}</a></div>
                            @endif
                            <div>Отправлено: <br/>{{ $message->created_at }}</div>
                        </div>
                        <p><b>Тема</b>:<br/>{{ $message->theme }}</p>
                        <p><b>Сообщение</b>:<br/>{{ $message->message }}</p>
                    </div>
                </div>
                <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                    <x-applicant-component />
                </div>
            </div>
</div>



    </section>
</main>
@endsection
