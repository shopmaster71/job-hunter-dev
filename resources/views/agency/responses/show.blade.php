@extends('layouts.app')
@section('title',  'Сообщение')
@section('description', 'Сообщение')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
<main class="main grow ">
    <section class="">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                    <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">{{ $response->position }}</h1>
                    <div class="mt-3 lg:mt-6">
                        <p><b>Соискатель</b>:<br/>
                            <a href="{{ route('applicant.profile', ['slug' => $response->getApplicant->slug]) }}" target="_blank">{{ $response->getApplicant->name }} {{ $response->getApplicant->surname }}</a></p>
                        <p><b>Отклик</b>:<br/>{{ $response->resp }}</p>
                        @if($response->resume)
                            <p><b>Резюме</b>:<br/><a href="{{ $response->resume }}" target="_blank">Смотреть</a></p>
                        @endif
                    </div>
                </div>
                <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                    <x-agency-component />
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
