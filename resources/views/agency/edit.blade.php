@extends('layouts.app')
@section('title',  'Изменение информации о агенстве')
@section('description', 'Изменение информации о агенстве')
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
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение информации о агенстве</h2>
                            <form action="{{ route('agency.update', ['agency' => $agency->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Название <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="title" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                                appearance-none focus:outline-none focus:ring-0 peer" placeholder="Название агентства" value="{{ $agency->title }}" />
                                                @if ($errors->has('title'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('title')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">E-mail <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="email" name="email" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="agency@mail.ru" value="{{ $agency->email }}" />
                                                @if ($errors->has('email'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Регион/Город <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list" placeholder="Начните вводить город" value="{{ $agency->city_name }}" autocomplete="off">
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="ул. Советская, д. 25" value="{{ $agency->address }}" />
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="+7(000) 000-00-00" value="{{ $agency->phone }}" />
                                                @if ($errors->has('phone'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('phone')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">VK </label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="vk" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://vk.com/agency" value="{{ $agency->vk }}" />
                                                @if ($errors->has('vk'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('vk')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Telegram</label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="telegram" class="block w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://tg.me/agency" value="{{ $agency->telegram }}" />
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

