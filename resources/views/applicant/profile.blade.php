@extends('layouts.app')
@section('title',  'Профиль соискателя')
@section('description', 'Профиль соискателя')
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow">
        <section class="py-3 md:py-0 h-full overflow-hidden">
            <div class="container mx-auto h-full">
                <div class=" flex flex-col md:flex-row justify-start w-full h-full relative">
                    <aside class="with-applicant-aside bg-white md:bg-blue-primary w-full md:w-1/3 relative py-0 md:py-7 pr-o md:pr-5 rounded-tr-xl rounded-br-xl">
                        <img src="{{ asset($applicant->photoUrl) }}" class="rounded-lg" alt="">
                        <div class="mt-6 md:text-white text-blue-primary">
                            <h2 class="font-semibold text-3xl">{{ $applicant->name }} {{ $applicant->surname }}</h2>
                            {{--<p class="font-semibold text-xl mt-1">Слесарь-сантехник</p>--}}
                            <div class="my-8">
                                <a href="#" rel="message" class="open_popup btn-utp-green  py-3 px-12 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Напишите мне</a>
                            </div>
                        </div>
                        <div class="mt-3 md:mt-6 md:text-white text-blue-primary">
                            <dl>
                                <dt class="text-lg mb-1 uppercase">Личная информация</dt>
                                <dd><b>Регион/Город:</b> {{ $applicant->city }}</dd>
                                <dd><b>Возраст, лет:</b> {{ $birth }}</dd>
                                <dd><b>Пол:</b> {{ $applicant->gender }}</dd>
                                <dd><b>Гражданство:</b> {{ $applicant->citizenship }}</dd>
                                <dd><b>Образование:</b> {{ $applicant->education }}</dd>
                                @if($applicant->driving_licence)
                                    <dd><b>Водительское удостоверение:</b> Есть</dd>
                                @endif
                                @if($applicant->married)
                                    <dd><b>Семейное положение:</b> {{ $applicant->gender == 'Мужской' ? 'Женат' : 'Замужем' }}</dd>
                                @else
                                    <dd><b>Семейное положение:</b> {{ $applicant->gender == 'Мужской' ? 'Холост' : 'Не замужем' }}</dd>
                                @endif
                                @if($applicant->children)
                                    <dd><b>Дети:</b> Есть</dd>
                                @endif
                            </dl>
                        </div>
                        <div class="mt-3 md:mt-6 md:text-white text-blue-primary">
                            <dl>
                                <dt class="text-lg mb-1 uppercase">Контакты</dt>
                                <dd><b>Телефон:</b> <a href="tel:+{{ preg_replace("/[^0-9]/", "", $applicant->getContact->phone) }}">{{ $applicant->getContact->phone }}</a></dd>
                                <dd><b>E-mail:</b> <a href="mailto:{{ $applicant->getContact->email }}">{{ $applicant->getContact->email }}</a></dd>
                                @if($applicant->getContact->vk && $applicant->getContact->vk_check)
                                    <dd><b>VK:</b> <a href="{{ $applicant->getContact->vk }}">{{ $applicant->getContact->vk }}</a></dd>
                                @endif
                                @if($applicant->getContact->telegram && $applicant->getContact->telegram_check)
                                    <dd><b>Telegram:</b> <a href="{{ $applicant->getContact->telegram }}">{{ $applicant->getContact->telegram }}</a></dd>
                                @endif
                            </dl>
                        </div>
                    </aside>
                    <div class="w-full mt-6 md:mt-0 md:w-2/3 pl-0 md:pl-10">
                        <h2 class="font-semibold text-2xl/6">Опыт работы</h2>
                        <div class="mt-0">
                            @if(count($applicant->getExperiences))
                                @foreach($applicant->getExperiences as $experience)
                                    <div class="mt-2 md:mt-5 pt-1 pb-3 md:pb-8 last:border-0 border-b border-b-[#cccccc]">
                                        <dl class="">
                                            <dt class="text-lg md:text-xl">Должность: <b>{{ $experience->position }}</b></dt>
                                            <dd class="mt-1 md:mt-2">Время работы: <b>{{ $experience->period_start }} - {{ $experience->present ? 'по настоящее время': $experience->period_end}}</b></dd>
                                            <dd class="mt-1 md:mt-2">Город: <b>{{ $experience->city }}</b></dd>
                                            <dd class="mt-1 md:mt-2">Организация: <b>{{ $experience->organization }}</b></dd>
                                        </dl>
                                        <h3 class="my-2 md:my-4 font-semibold text-lg md:text-xl">Обязанности и достижения:</h3>
                                        <p class="text-base md:text-lg">{{ $experience->description }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p>Данные о предидущих местах работы отсутствуют.</p>
                            @endif
                        </div>
                        <h2 class="font-semibold text-2xl/6">Образование</h2>
                        <div class="mt-0">
                            @if(count($applicant->getEducations))
                                @foreach($applicant->getEducations as $education)
                                    <div class="mt-2 md:mt-5 pt-1 pb-3 md:pb-8 last:border-0 border-b border-b-[#cccccc] ">
                                        <dl>
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
                                    </div>
                                @endforeach
                            @else
                                <p>Данные о образовании отсутствуют</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Отклик начало-->
        <div class="popup popup-primary message w-[352px] -ml-44 sm:w-[600px] sm:ml-[-300px]">
            <div class="popup_header py-2 relative">
                <h3 class="text-2xl text-blue-primary font-medium">Сообщение</h3>
                <div class="close_popup"></div>
            </div>
            <div class="popup_body">
                <form action="{{ route('message.create', ['applicant' => $applicant->id]) }}" method="post">
                    @csrf
                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                        <div>
                            <label class="mb-2" for="email">E-mail<sup class="text-red-500">*</sup></label>
                            <input type="email" name="email" id="email" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="example@mail.ru" />
                            @if ($errors->has('email'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                            @endif
                        </div>
                        <div>
                            <label class="mb-2" for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" class="phone block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="+7(000) 000-00-00" />
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('phone')[0] }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="w-full mt-2 sm:mt-4">
                        <label class="mb-2" for="theme">Тема <sup class="text-red-500">*</sup></label>
                        <input type="text" name="theme" id="theme" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" placeholder="Тема сообщения" />
                        @if ($errors->has('theme'))
                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('theme')[0] }}</div>
                        @endif
                    </div>
                    <div class="w-full mt-2 mb-2 sm:mt-4">
                        <label class="mb-2" for="message">Сообщение <sup class="text-red-500">*</sup></label>
                        <textarea name="message" rows="5" class="block w-full outline-none border border-[#cccccc] rounded-lg px-3 py-3 text-[#8F8F8F]" id="message">Сообщение </textarea>
                        @if ($errors->has('message'))
                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('message')[0] }}</div>
                        @endif
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

