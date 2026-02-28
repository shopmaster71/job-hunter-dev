@extends('layouts.app')
@section('title',  'Профиль HR-менеджера '.$hr->name.' '.$hr->surname)
@section('description', 'Профиль HR-менеджера')
@section('body_class', 'bg-white')
@section('content')
    <main class="grow">
        <section class="bg-white mt-3 lg:mt-4 relative">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start gap-3 md:gap-4">
                    <div class="w-full lg:w-10/15">
                        <div class="flex flex-row justify-start lg:justify-between items-start flex-wrap gap-1">
                            <h1 class="text-lg md:text-2xl lg:text-4xl font-bold w-full lg:w-auto">{{ $hr->name }}<br/>
                                {{ $hr->surname }}</h1>
                            <div class="flex flex-row items-center gap-1 font-medium">
                                <a href="#" rel="message" class="open_popup py-1.5 px-4 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-full hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Написать мне</a>
                                <!--<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.03506 14.06L3.45108 17.1857L4.69822 10.9091L0 6.56434L6.35474 5.81088L9.03506 0L11.7153 5.81088L18.07 6.56434L13.3719 10.9091L14.619 17.1857L9.03506 14.06Z" fill="#27A746"/>
                                  </svg>
                                  <span class="text-lg">4.8</span>-->
                            </div>
                            <span class="text-lg pl-3 lg:pl-0">Стаж, лет: {{ $hr->getInformation->experience }}</span>
                        </div>
                        <h3 class="font-semibold text-lg mt-4">{{ $hr->getInformation->advantage }}</h3>
                        @if($hr->getInformation->services)
                        <div class="mt-2">
                            <h2 class="font-semibold text-3xl mt-4">Мои услуги</h2>
                            <div class="block md:flex flex-row justify-start flex-wrap items-center gap-3 mt-5">
                                @foreach(explode(',', $hr->getInformation->services) as $service)
                                    <span class="inline-block px-4 py-2  border border-[#8f8f8f] text-sm rounded-full mt-1">{{ $service }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="mt-10">
                            <cite class="block text-base lg:text-lg mb-2 lg:mb-3">«{{ $hr->getInformation->about }}»</cite>
                        </div>
                    </div>
                    <div class="w-full lg:w-5/15">
                        <div class="mt-1 lg:mt-12">
                            <img src="{{ asset($hr->getPhoto->photo ?:'assets/img/no-photo.webp') }}" class="rounded-lg" alt="{{ 'Профиль HR-менеджера '.$hr->name.' '.$hr->surname }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--
        <section class="body-grey-bg reviews mt-10 lg:mt-20 relative py-10 md:py-20">
            <div class="container mx-auto">
                <div class="reviews-header flex flex-col md:flex-row justify-between gap-3 md:gap-6">
                    <h2 class="font-semibold text-2xl/6 md:text-[40px]/7 w-full md:w-4/8 text-blue-primary">Отзывы моих клиентов</h2>
                    <p class="w-full md:w-4/8 text-blue-primary">«И нет сомнений, что акционеры крупнейших компаний неоднозначны и будут превращены, хотя само»</p>
                </div>
                <div class="reviews-list grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-6 w-full mt-5 md:mt-10 relative z-20">
                    <div class="reviews-item bg-white px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 rounded-lg min-h-0 sm:min-h-[236px] text-blue-primary">
                        <p class="h-auto sm:h-[120px] italic">И нет сомнений, что акционеры крупнейших компаний неоднозначны и будут превращены, хотя само их существование приносит пользу</p>
                        <div class="reviews-item-info">
                            <b class="block mb-1 mt-2 sm:mt-0">Руководитель отдела</b>
                            <p class=" text-[#53575C] text-[15px]/5">Строительная компания <br/>«Строим дома»</p>
                        </div>
                    </div>
                    <div class="reviews-item bg-white px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 rounded-lg min-h-0 sm:min-h-[236px] text-blue-primary">
                        <p class="h-auto sm:h-[120px] italic">Являясь всего лишь частью общей картины, стремящиеся вытеснить традиционное производство</p>
                        <div class="reviews-item-info">
                            <b class="block mb-1 mt-2 sm:mt-0">Исполнительный директор</b>
                            <p class=" text-[#53575C] text-[15px]/5">Косметическая компания<br/>«Ромашки и цветочки»</p>
                        </div>
                    </div>
                    <div class="reviews-item bg-white px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 rounded-lg min-h-0 sm:min-h-[236px] text-blue-primary">
                        <p class="h-auto sm:h-[120px] italic">С другой стороны, консультация с широким активом предполагает независимые способы реализации укрепления ценностей</p>
                        <div class="reviews-item-info">
                            <b class="block mb-1 mt-2 sm:mt-0">Отдел кадров</b>
                            <p class=" text-[#53575C] text-[15px]/5">«Новые технологии»</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        --}}
        <!--Отклик начало-->
        <div class="popup popup-primary message w-[352px] -ml-44 sm:w-[600px] sm:ml-[-300px]">
            <div class="popup_header py-2 relative">
                <h3 class="text-2xl text-blue-primary font-medium">Сообщение</h3>
                <div class="close_popup"></div>
            </div>
            <div class="popup_body">
                <form action="{{ route('hr.message.create', ['hr' => $hr->id]) }}" method="post">
                    @csrf
                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                        <div>
                            <label class="mb-2" for="email">E-mail<sup class="text-red-500">*</sup></label>
                            <input type="email" name="email" id="email" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="example@mail.ru" required />
                        </div>
                        <div>
                            <label class="mb-2" for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" class="phone block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="+7(000) 000-00-00" />
                        </div>
                    </div>
                    <div class="w-full mt-2 sm:mt-4">
                        <label class="mb-2" for="message">Тема <sup class="text-red-500">*</sup></label>
                        <input type="text" name="theme" id="theme" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="Тема сообщения" required />
                    </div>
                    <div class="w-full mt-2 sm:mt-4 mb-4">
                        <label class="mb-2" for="message">Сообщение <sup class="text-red-500">*</sup></label>
                        <textarea name="message" rows="5" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" id="message" required>Сообщение </textarea>
                    </div>
                    <x-yandex-captcha />
                    <div class="mt-3">
                        <button class="py-3 px-12 text-white disabled:text-[#8F8F8F] text-base bg-green-primary disabled:bg-[#cccccc] border border-solid disabled:border-[#cccccc] border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Отклик конец-->
    </main>
@endsection

