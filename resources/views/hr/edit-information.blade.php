@extends('layouts.app')
@section('title',  'Кабинет соискателя - Изменение профессиональной информации')
@section('description', 'Изменение профессиональной информации')
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
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение профессиональной информации</h2>
                            <form action="{{ route('hr.information.update', ['hr' => $hr->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Отрасль<sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="sector">
                                                    <option value="1" @if($hr->getInformation->sector == 1) selected @endif>Медицина</option>
                                                    <option value="2" @if($hr->getInformation->sector == 2) selected @endif>Строительство</option>
                                                    <option value="3" @if($hr->getInformation->sector == 3) selected @endif>Производство</option>
                                                    <option value="4" @if($hr->getInformation->sector == 4) selected @endif>Сельское хозяйство</option>
                                                    <option value="5" @if($hr->getInformation->sector == 4) selected @endif>Бытовые услуги</option>
                                                </select>
                                                @if ($errors->has('sector'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('sector')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Стаж работы <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="experience" class="input-number block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="10" value="{{ $hr->getInformation->experience }}" />
                                                @if ($errors->has('experience'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('experience')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Город <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1" id="regions">
                                                <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list"
                                                       placeholder="Начните вводить город"
                                                       value="{{ $hr->getInformation->city_name }}"
                                                >
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
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Услуги<sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <!-- Контейнер для выбранных услуг -->
                                                <div id="servicesContainer" class="flex flex-wrap gap-2"></div>
                                                <!-- Поле ввода -->
                                                <div class="relative">
                                                    <input type="text" name="services"  id="servicesInput" placeholder="Введите услуги через запятую"
                                                           class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                                        appearance-none focus:outline-none focus:ring-0 peer" value="{{ $hr->getInformation->services }}" />
                                                </div>
                                                @if ($errors->has('services'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('services')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                    <label class="w-full md:w-3/16 text-base md:text-lg">Ваше преимущество</label>
                                    <div class="w-full md:w-13/16 py-1">
                                            <textarea rows="2"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о Вашем главном преимуществе." name="advantage">{{ $hr->getInformation->advantage }}</textarea>
                                        @if ($errors->has('advantage'))
                                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('advantage')[0] }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                    <label class="w-full md:w-3/16 text-base md:text-lg text-blue-primary">О себе<sup class="text-red-500">*</sup></label>
                                    <div class="w-full md:w-13/16 py-1">
                                    <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о себе" name="about">{{ $hr->getInformation->about }}</textarea>
                                        @if ($errors->has('about'))
                                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('about')[0] }}</div>
                                        @endif
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
        document.addEventListener('DOMContentLoaded', function () {
            const servicesInput = document.getElementById('servicesInput');
            const servicesContainer = document.getElementById('servicesContainer');

            // Массив для хранения услуг
            let services = [];

            // === ИНИЦИАЛИЗАЦИЯ: Загружаем существующие услуги из value ===
            if (servicesInput.value.trim()) {
                const initialServices = servicesInput.value
                    .split(',')
                    .map(s => s.trim())
                    .filter(s => s);

                services = [...new Set(initialServices)]; // Убираем дубликаты
                updateServicesDisplay(); // Отображаем теги
            }

            // Функция обновления отображения
            function updateServicesDisplay() {
                servicesContainer.innerHTML = '';

                services.forEach((service, index) => {
                    const tag = document.createElement('div');
                    tag.className = 'inline-flex items-center bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full';

                    const text = document.createElement('span');
                    text.textContent = service;
                    tag.appendChild(text);

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'ml-2 text-blue-600 hover:text-blue-800 focus:outline-none';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.setAttribute('aria-label', `Удалить ${service}`);

                    removeBtn.addEventListener('click', () => {
                        services.splice(index, 1);
                        updateServicesDisplay();
                        updateInputField();
                    });

                    tag.appendChild(removeBtn);
                    servicesContainer.appendChild(tag);
                });

                // Обновляем поле ввода (для отправки)
                updateInputField();
            }

            // Обновляем значение скрытого/видимого поля
            function updateInputField() {
                servicesInput.value = services.join(', ');
            }

            // Таймер для автосохранения после ввода (10 секунд без действий)
            let inputTimeout = null;

            servicesInput.addEventListener('input', function () {
                if (inputTimeout) clearTimeout(inputTimeout);

                const val = this.value.trim();

                inputTimeout = setTimeout(() => {
                    const newItems = val.split(',')
                        .map(s => s.trim())
                        .filter(s => s && !services.includes(s));

                    if (newItems.length > 0) {
                        services.push(...newItems);
                        updateServicesDisplay();
                    }

                    if (val.endsWith(',') && val.length > 1) {
                        const last = val.substring(0, val.length - 1).split(',').pop().trim();
                        if (last && !services.includes(last)) {
                            services.push(last);
                            updateServicesDisplay();
                        }
                    }

                    this.value = '';
                }, 10000);
            });

            // При потере фокуса — добавить оставшиеся
            servicesInput.addEventListener('blur', function () {
                if (inputTimeout) clearTimeout(inputTimeout);

                const val = this.value.trim();
                if (val) {
                    const newItems = val.split(',')
                        .map(s => s.trim())
                        .filter(s => s && !services.includes(s));

                    if (newItems.length > 0) {
                        services.push(...newItems);
                        updateServicesDisplay();
                    }

                    this.value = '';
                }
            });

            // По Enter — мгновенно добавить
            servicesInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    if (inputTimeout) {
                        clearTimeout(inputTimeout);
                        inputTimeout = null;
                    }

                    const val = this.value.trim();
                    if (val) {
                        const newItems = val.split(',')
                            .map(s => s.trim())
                            .filter(s => s && !services.includes(s));

                        if (newItems.length > 0) {
                            services.push(...newItems);
                            updateServicesDisplay();
                        }

                        this.value = '';
                    }
                }
            });

            // Перед отправкой формы — убедиться, что все услуги в поле
            document.querySelector('form').addEventListener('submit', function () {
                const currentValue = servicesInput.value.trim();
                if (currentValue) {
                    const remaining = currentValue.split(',')
                        .map(s => s.trim())
                        .filter(s => s && !services.includes(s));
                    services.push(...remaining);
                }

                // Уникальность и обновление значения
                services = [...new Set(services)];
                updateInputField();
            });
        });
    </script>

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





