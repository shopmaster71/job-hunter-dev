@extends('layouts.app')
@section('title',  'Кадровое агентство '.isset($agency->title))
@section('description', 'Кадровое агентство '.isset($agency->title))
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start  gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
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
                        <h2 class="font-semibold text-lg md:text-2xl/6">Контактная информация</h2>
                        @if(!isset($agency))
                        <form action="{{ route('agency.create') }}" method="post">
                            @csrf
                            <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Название <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="text" name="title" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Название агентства" value="{{ old('title') }}" />
                                            @if ($errors->has('title'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('title')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">E-mail <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="email" name="email" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="agency@mail.ru" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Регион/Город <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 relative">
                                            <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list" placeholder="Начните вводить город" value="{{ old('city_name') }}" autocomplete="off">
                                            <datalist id="cities-list">
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->name }}">
                                                @endforeach
                                            </datalist>
                                            @if ($errors->has('city_name'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('city_name')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Адрес <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="text" name="address" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="ул. Советская, д. 25" value="{{ old('address') }}" />
                                            @if ($errors->has('address'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('address')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Телефон <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="text" name="phone" class="phone block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="+7(000) 000-00-00" value="{{ old('phone') }}" />
                                            @if ($errors->has('phone'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('phone')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">VK </label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="text" name="vk" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://vk.com/agency" value="{{ old('vk') }}" />
                                            @if ($errors->has('vk'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('vk')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Telegram</label>
                                        <div class="w-full md:w-5/8 py-1">
                                            <input type="text" name="telegram" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://tg.me/agency" value="{{ old('telegram') }}" />
                                            @if ($errors->has('telegram'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('telegram')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-8">
                                <button class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Сохранить</button>
                            </div>
                        </form>
                        @else
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 mt-6 text-base md:text-lg">
                                <li class="bg-gray-50 py-2 px-3"><b>Название агентства:</b> {{ $agency->title }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Город:</b> {{ $agency->city_name }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Адрес:</b> {{ $agency->address }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>E-mail:</b> {{ $agency->email }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Телефон:</b> {{ $agency->phone }}</li>
                                @if($agency->vk)
                                    <li class="bg-gray-50 py-2 px-3"><b>В контакте:</b> {{ $agency->vk }}</li>
                                @endif
                                @if($agency->telegram)
                                    <li class="bg-gray-50 py-2 px-3"><b>Телеграм:</b> {{ $agency->telegram }}</li>
                                @endif
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('agency.edit', ['agency' => $agency->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif
                    </div>

                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Профессиональная информация</h2>
                        @if(!isset($agency->getInformation))
                        <form action="{{ route('agency.information.create') }}" method="post">
                            @csrf
                            <div class="mt-2 lg:mt-6 flex flex-col gap-1 lg:gap-2">
                                <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                    <label class="w-full md:w-5/16 text-base md:text-lg text-blue-primary">Главное преимущество <sup class="text-red-500">*</sup></label>
                                    <div class="w-full md:w-11/16 py-1">
                                        <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                        appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о Вашем главном преимуществе." name="advantage">{{ old('telegram') }}</textarea>
                                        @if ($errors->has('advantage'))
                                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('advantage')[0] }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                    <label class="w-full md:w-5/16 text-base md:text-lg text-blue-primary">О агентстве<sup class="text-red-500">*</sup></label>
                                    <div class="w-full md:w-11/16 py-1">
                                        <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                        appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о агенстве, его целях и миссии" name="about">{{ old('about') }}</textarea>
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
                        @else
                            <ul class="grid grid-cols-1 gap-4 mt-6 text-base md:text-lg">
                                <li class="bg-gray-50 py-2 px-3"><b>Преимущества агентства</b>:</b> {{ $agency->getInformation->advantage }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>О агенстве:</b> {{ $agency->getInformation->about }}</li>
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('agency.information.edit', ['agency' => $agency->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')

    <script>
        document.getElementById('city_name').addEventListener('input', function () {
            const query = this.value;
            if (query.length < 2) return;

            fetch('{{ route("cities.search") }}?q=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    const datalist = document.getElementById('cities-list');
                    datalist.innerHTML = ''; // Очистим старые варианты

                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        datalist.appendChild(option);
                    });
                })
                .catch(err => console.warn('Ошибка загрузки городов:', err));
        });
    </script>

@endpush

