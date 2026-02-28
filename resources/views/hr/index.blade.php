@extends('layouts.app')
@section('title',  'Кабинет HR-менеджера')
@section('description', 'Кабинет HR-менеджера')
@section('body_class', 'bg-[#F5F6F8]')
@section('assets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

@endsection
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
                        <div id="avatar-section" class="photo-button mt-5 lg:mt-9">
                            @if ($user->photo)
                                <!-- Показываем существующее фото -->
                                <div id="current-avatar-wrapper" class="text-center w-60 h-60 md:w-80 md:h-80 relative">
                                    <img src="{{ asset($user->photo->photo) . '?t=' . time() }}"
                                         alt="Аватар"
                                         class="w-60 h-60 md:w-80 md:h-80 border-4 border-gray-200"
                                         id="user-avatar-preview">
                                    <button type="button"
                                            onclick="startChangeAvatar()"
                                            class="absolute left-2 right-2 bottom-10 cursor-pointer inline-block mt-4 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm transition">
                                        Изменить
                                    </button>
                                </div>

                                <!-- Скрываем dropZone изначально -->
                                <div id="dropZone" class="hidden w-60 h-60 md:w-80 md:h-80 flex justify-center items-center border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-primary transition cursor-pointer bg-gray-50">
                                    <div>
                                        <div class="text-blue-primary text-lg md:text-3xl font-semibold uppercase">Фото</div>
                                        <p class="text-gray-500 mb-3 mt-3">Перетащите изображение сюда или нажмите, чтобы выбрать</p>
                                        <input type="file" id="imageInput" accept="image/*" class="hidden" />
                                        <!-- Прогресс-бар -->
                                        <div id="progressContainer" class="hidden mt-4">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div id="progressBar" class="bg-green-primary h-2 rounded-full transition-all duration-200" style="width: 0%"></div>
                                            </div>
                                            <p id="progressText" class="text-xs text-gray-500 mt-1">Загрузка: 0%</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Нет фото — показываем dropZone сразу -->
                                <div id="dropZone" class="w-60 h-60 md:w-80 md:h-80 flex justify-center items-center border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-primary transition cursor-pointer bg-gray-50">
                                    <div>
                                        <div class="text-blue-primary text-lg md:text-3xl font-semibold uppercase">Фото</div>
                                        <p class="text-gray-500 mb-3 mt-3">Перетащите изображение сюда или нажмите, чтобы выбрать</p>
                                        <input type="file" id="imageInput" accept="image/*" class="hidden" />
                                        <!-- Прогресс-бар -->
                                        <div id="progressContainer" class="hidden mt-4">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div id="progressBar" class="bg-green-primary h-2 rounded-full transition-all duration-200" style="width: 0%"></div>
                                            </div>
                                            <p id="progressText" class="text-xs text-gray-500 mt-1">Загрузка: 0%</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Скрытый редактор Cropper.js (остаётся как есть) -->
                            <div class="editor mt-8 hidden">
                                <img id="image" src="" alt="Изображение для обрезки" class="max-w-full h-96 mx-auto bg-gray-100 border border-dashed border-gray-300 rounded-lg object-contain">
                                <div class="controls mt-6">
                                    <!-- Кнопки -->
                                    <div class="flex flex-wrap justify-center gap-3">
                                        <button id="rotateLeft" class="cursor-pointer px-5 py-2 bg-gray-400 hover:bg-gray-500 text-white font-medium rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                            Повернуть влево
                                        </button>
                                        <button id="rotateRight" class="cursor-pointer px-5 py-2 bg-green-primary hover:bg-green-600 text-white font-medium rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                            Повернуть вправо
                                        </button>
                                        <button id="crop" class="cursor-pointer px-5 py-2 bg-blue-primary hover:bg-blue-950 text-white font-medium rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                            Обрезать и сохранить
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Превью результата -->
                            <div id="result" class="result max-w-60 lg:max-w-80 mt-8 hidden text-center relative">
                                <img id="resultImage" alt="Обработанное изображение" class="max-w-60 max-h-60 md:max-w-80 md:max-h-80 rounded-lg border border-gray-300 shadow-sm" />
                                <button id="editAgain" class="absolute left-2 right-2 bottom-10 cursor-pointer inline-block mt-4 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm transition">
                                    Изменить изображение
                                </button>
                            </div>
                            <div id="errorMessage" class="text-red-500 text-sm mt-2 hidden"></div>
                        </div>
                    </div>

                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-hr-component />

                        <div class="text-blue-primary profile-rate border-t border-t-[#cccccc] mt-3 pt-3 lg:mt-10 lg:pt-10 mb-1 lg:mb-4">
                            <div class="inline lg:block text-[#53575C] text-lg lg:text-2xl w-full lg:w-[200px]">Профиль заполнен на</div>
                            <span class="inline lg:block font-medium text-[#1A702F] text-3xl lg:text-[40px]/10 mt-1">{{ $level }}%</span>
                            <p class="mt-2 lg:mt-4 text-lg/6 pr-10">Полностью заполненный профиль повысит эффективность на 40%</p>
                            {{--
                            <div class="w-full mt-4 lg:mt-9 py-3">
                                <a href="#" class="btn-utp-green inline w-full grow py-3 px-10 text-white  text-base:text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Заполнить</a>
                            </div>
                            --}}
                        </div>

                    </div>

                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Личная информация</h2>
                        @if(!$hr)
                        <form action="{{ route('hr.create') }}" method="post">
                            @csrf
                            <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Фамилия <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8">
                                            <input type="text" name="surname" class="block py-1 w-full text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Фамилия" value="{{ old('surname') }}" />
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Имя" value="{{ old('name') }}" />
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
                        @else
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 mt-6 text-base md:text-lg">
                                <li class="bg-gray-50 py-2 px-3"><b>Имя:</b> {{ $hr->name }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Фамилия:</b> {{ $hr->surname }}</li>
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('hr.edit', ['hr' => $hr->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif

                    </div>
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Профессиональная информация</h2>
                        @if(!$hrInformation)
                        <form action="{{ route('hr.information.create') }}" method="post" id="proform">
                            @csrf
                            <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Отрасль<sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 profile-fields relative border-b border-[#cccccc] ">
                                            <select class="select block w-full new_select" name="sector">
                                                <option selected>Отрасль/сфера деятельности</option>
                                                <option value="1">Медицина</option>
                                                <option value="2">Строительство</option>
                                                <option value="3">Производство</option>
                                                <option value="4">Сельское хозяйство</option>
                                                <option value="5">Бытовые услуги</option>
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="10" value="{{ old('experience') }}" />
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
                                                value="{{ old('city_name') }}"
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
                                                        appearance-none focus:outline-none focus:ring-0 peer" />
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о Вашем главном преимуществе." name="advantage">{{ old('advantage') }}</textarea>
                                    @if ($errors->has('advantage'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('advantage')[0] }}</div>
                                    @endif
                                </div>
                            </div>



                            <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                <label class="w-full md:w-3/16 text-base md:text-lg text-blue-primary">О себе<sup class="text-red-500">*</sup></label>
                                <div class="w-full md:w-13/16 py-1">
                                    <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="Расскажите о себе" name="about">{{ old('about') }}</textarea>
                                    @if ($errors->has('about'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('about')[0] }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full mt-8">
                                <button class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Сохранить</button>
                            </div>
                        </form>
                        @else
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4 mt-6 text-base md:text-lg">
                                <li class="bg-gray-50 py-2 px-3"><b>Отрасль:</b> {{ array_search($hrInformation->sector, ['Медицина' => 1, 'Строительство' => 2, 'Производство' => 3, 'Сельское хозяйство' => 4, 'Бытовые услуги' => 5]) }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Город:</b> {{ $hrInformation->city_name }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Стаж работы, лет:</b> {{ $hrInformation->experience }}</li>
                            </ul>
                            <ul class="grid grid-cols-1 gap-2 sm:gap-4 mt-4 text-base md:text-lg">
                                <li class="bg-gray-50 py-2 px-3"><b>Услуги:</b> {{ $hrInformation->services }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Главное преимущество:</b> {{ $hrInformation->advantage }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>О себе:</b> {{ $hrInformation->about }}</li>
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('hr.information.edit', ['hr' => $hr->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        let cropper;

        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('imageInput');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');

        // Показать прогресс (симуляция — файл читается быстро, но добавим плавность)
        function showProgress(callback) {
            progressContainer.classList.remove('hidden');
            let width = 0;
            const interval = setInterval(() => {
                width += 5;
                if (width >= 100) {
                    width = 100;
                    clearInterval(interval);
                    setTimeout(() => {
                        progressContainer.classList.add('hidden');
                        setTimeout(() => {
                            if (callback) callback();
                        }, 200);
                    }, 300);
                }
                progressBar.style.width = width + '%';
                progressText.textContent = `Загрузка: ${width}%`;
            }, 50);
        }

        // Функция обработки файла
        function handleFile(file) {
            // Проверка размера файла (10 КБ – 5 МБ)
            const MIN_FILE_SIZE = 10 * 1024;
            const MAX_FILE_SIZE = 5 * 1024 * 1024;

            if (file.size < MIN_FILE_SIZE) {
                showError('Размер файла слишком мал. Минимум 10 КБ.');
                return;
            }
            if (file.size > MAX_FILE_SIZE) {
                showError('Размер файла слишком велик. Максимум 5 МБ.');
                return;
            }

            showProgress(() => {
                const imageUrl = URL.createObjectURL(file);
                const image = document.getElementById('image');

                const img = new Image();
                img.onload = function () {
                    const { width, height } = img;

                    if (width < 300 || height < 300) {
                        showError('Изображение слишком маленькое. Минимум 300×300 пикселей.');
                        URL.revokeObjectURL(imageUrl);
                        return;
                    }
                    if (width > 1500 || height > 1500) {
                        showError('Изображение слишком большое. Максимум 1500×1500 пикселей.');
                        URL.revokeObjectURL(imageUrl);
                        return;
                    }

                    // Показать редактор
                    dropZone.classList.add('hidden');
                    document.querySelector('.editor').classList.remove('hidden');
                    image.src = imageUrl;

                    if (cropper) cropper.destroy();

                    image.onload = function () {
                        cropper = new Cropper(image, {
                            aspectRatio: 1, // можно оставить или изменить
                            viewMode: 1,
                            autoCropArea: 0.9,
                            movable: true,
                            rotatable: true,
                            scalable: true,
                            zoomable: false,
                            background: true,
                            guides: true,
                            center: true,

                            // Ограничение минимального размера рамки обрезки
                            minCropBoxWidth: 400,
                            minCropBoxHeight: 400,

                            // Ограничение максимального размера рамки обрезки
                            maxCropBoxWidth: 500,
                            maxCropBoxHeight: 500,

                            // Опционально: ограничить минимальный размер canvas (редко нужно)
                            minCanvasWidth: 400,
                            minCanvasHeight: 400,
                        });
                    };
                };
                img.onerror = () => showError('Не удалось загрузить изображение.');
                img.src = imageUrl;
            });

            function showError(message) {
                const errorEl = document.getElementById('errorMessage');
                errorEl.textContent = message;
                errorEl.classList.remove('hidden');
                setTimeout(() => errorEl.classList.add('hidden'), 5000);
            }
        }

        // Клик по зоне
        dropZone.addEventListener('click', () => {
            imageInput.click();
        });

        // Выбор файла через input
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) handleFile(file);
        });

        // Drag & Drop события
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('bg-blue-50', 'border-blue-400');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('bg-blue-50', 'border-blue-400');
            });
        });

        dropZone.addEventListener('drop', (e) => {
            const file = e.dataTransfer.files?.[0];
            if (file && file.type.startsWith('image/')) {
                handleFile(file);
            } else {
                alert('Пожалуйста, перетащите изображение.');
            }
        });

        // Поворот
        document.getElementById('rotateLeft').addEventListener('click', () => {
            if (cropper) cropper.rotate(-90);
        });

        document.getElementById('rotateRight').addEventListener('click', () => {
            if (cropper) cropper.rotate(90);
        });

        // Обрезка и закрытие редактора
        document.getElementById('crop').addEventListener('click', () => {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 800,
                fillColor: '#fff',
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            if (canvas) {
                const resultImage = document.getElementById('resultImage');
                //resultImage.src = canvas.toDataURL('image/jpeg', 0.9);

                canvas.toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('image', blob, 'photo.webp');

                    fetch('/media', {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin',  // ← КРИТИЧЕСКИ ВАЖНО: отправлять куки
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                        // Не нужен Content-Type — браузер сам установит
                        /*  headers: {
                              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                          }*/
                    })
                        .then(response => response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                console.error('Invalid JSON:', text);
                                throw e;
                            }
                        }))
                        .then(data => {
                            console.log('Фото загружено:', data.url);
                            // 1. Обновляем изображение в #current-avatar-wrapper
                            const avatarImg = document.getElementById('user-avatar-preview');
                            if (avatarImg) {
                                avatarImg.src = data.url + '?t=' + Date.now();
                            }

                            // 2. Показываем блок с аватаром и кнопкой "Изменить"
                            const currentWrapper = document.getElementById('current-avatar-wrapper');
                            if (currentWrapper) {
                                currentWrapper.style.display = 'block'; // или .classList.remove('hidden')
                            }

                            // 3. Скрываем окно результата (если оно открылось)
                            const result = document.getElementById('result');
                            if (result) {
                                result.classList.add('hidden');
                            }

                            // 4. Скрываем редактор (если нужно)
                            const editor = document.querySelector('.editor');
                            if (editor) {
                                editor.classList.add('hidden');
                            }

                            // 5. Очищаем input
                            const imageInput = document.getElementById('imageInput');
                            if (imageInput) {
                                imageInput.value = '';
                            }

                            // После успешной загрузки
                            //document.getElementById('resultImage').classList.add('hidden');

                            // Обновляем аватар в интерфейсе
                            if (avatarImg) {
                                avatarImg.src = data.url + '?t=' + Date.now(); // ?t= — обход кеша
                            } else {
                                const wrapper = document.createElement('div');
                                wrapper.id = 'current-avatar-wrapper';
                                wrapper.className = 'text-center w-60 h-60 md:w-80 md:h-80 relative';
                                wrapper.innerHTML = `
                                    <img src="${data.url}?t=${Date.now()}"
                                    alt="Аватар"
                                    class="w-60 h-60 md:w-80 md:h-80 border-4 border-gray-200"
                                    id="user-avatar-preview">
                                    <button type="button" onclick="startChangeAvatar()"
                                    class="absolute left-2 right-2 bottom-10 cursor-pointer inline-block mt-4 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm transition">
                                    Изменить
                                    </button>
                                `;
                                document.getElementById('avatar-section').prepend(wrapper);
                            }

                            // Скрываем dropZone после загрузки
                            //document.getElementById('dropZone').classList.add('hidden');
                        })
                        .catch(console.error);
                }, 'image/webp', 0.9);
                document.getElementById('result').classList.remove('hidden');
                document.querySelector('.editor').classList.add('hidden');
            }
            cropper.destroy();
            cropper = null;
        });

        // Выбор соотношения сторон
        /*document.getElementById('aspectRatioSelect').addEventListener('change', (e) => {
          const ratio = e.target.value;
          let aspectRatio = 1;

          switch (ratio) {
            case '1': aspectRatio = 1; break;
            case '4/3': aspectRatio = 4 / 3; break;
            case '16/9': aspectRatio = 16 / 9; break;
            case 'free': aspectRatio = NaN; break;
          }

          if (cropper) {
            cropper.setAspectRatio(aspectRatio);
          }
        });*/

        document.getElementById('editAgain').addEventListener('click', () => {
            document.getElementById('result').classList.add('hidden');
            dropZone.classList.remove('hidden');
            dropZone.value = ''; // сброс
        });



    </script>
    <script>
        function startChangeAvatar() {
            // Скрываем текущее фото
            document.getElementById('current-avatar-wrapper').style.display = 'none';

            // Показываем зону загрузки
            const dropZone = document.getElementById('dropZone');
            dropZone.classList.remove('hidden');

            // Очищаем предыдущий выбор файла (если был)
            document.getElementById('imageInput').value = '';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const servicesInput = document.getElementById('servicesInput');
            const servicesContainer = document.getElementById('servicesContainer');
            const result = document.getElementById('result');
            const servicesList = document.getElementById('servicesList');
            const testButton = document.getElementById('testButton');

            // Массив для хранения услуг
            let services = [];

            // Функция для обновления отображения услуг
            function updateServicesDisplay() {
                // Очищаем контейнер
                servicesContainer.innerHTML = '';

                // Добавляем каждую услугу как тег
                services.forEach((service, index) => {
                    const serviceTag = document.createElement('div');
                    serviceTag.className = 'inline-flex items-center bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full';

                    // Текст услуги
                    const serviceText = document.createElement('span');
                    serviceText.textContent = service.trim();
                    serviceTag.appendChild(serviceText);

                    // Кнопка удаления
                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className = 'ml-2 text-blue-600 hover:text-blue-800 focus:outline-none';
                    removeButton.innerHTML = '&times;';
                    removeButton.setAttribute('aria-label', `Удалить услугу ${service}`);

                    // Обработчик удаления
                    removeButton.addEventListener('click', function() {
                        services.splice(index, 1);
                        updateServicesDisplay();
                        updateInputField();
                    });

                    serviceTag.appendChild(removeButton);
                    servicesContainer.appendChild(serviceTag);
                });

                // Обновляем поле ввода
                updateInputField();
            }

            // Функция для обновления поля ввода
            function updateInputField() {
                servicesInput.value = services.join(', ');
            }

            let inputTimeout = null;

            // Обработчик ввода
            servicesInput.addEventListener('input', function() {
                // Очищаем предыдущий таймаут
                if (inputTimeout) {
                    clearTimeout(inputTimeout);
                }

                const inputValue = this.value;

                // Устанавливаем таймаут на 10 секунд
                inputTimeout = setTimeout(() => {
                    // Разделяем ввод по запятым
                    const inputServices = inputValue.split(',').map(service => service.trim()).filter(service => service.length > 0);

                    // Находим новые услуги (которые еще не в массиве)
                    const newServices = inputServices.filter(service => !services.includes(service));

                    // Добавляем новые услуги
                    if (newServices.length > 0) {
                        services.push(...newServices);
                        updateServicesDisplay();
                    }

                    // Проверяем, была ли удалена запятая или текст был очищен
                    if (inputValue === '' || inputValue.endsWith(',')) {
                        // Если ввод заканчивается запятой, добавляем последнюю часть как услугу
                        const lastPart = inputValue.substring(0, inputValue.length - 1).split(',').pop().trim();
                        if (lastPart && !services.includes(lastPart)) {
                            services.push(lastPart);
                            updateServicesDisplay();
                        }
                    }

                    // Очищаем поле ввода после добавления услуг
                    this.value = '';
                }, 10000); // 10 секунд
            });

            // При потере фокуса, срабатывает немедленно
            servicesInput.addEventListener('blur', function() {
                if (inputTimeout) {
                    clearTimeout(inputTimeout);
                }

                const inputValue = this.value.trim();
                if (inputValue) {
                    const inputServices = inputValue.split(',').map(service => service.trim()).filter(service => service.length > 0);
                    let updated = false;

                    inputServices.forEach(service => {
                        if (service && !services.includes(service)) {
                            services.push(service);
                            updated = true;
                        }
                    });

                    if (updated) {
                        updateServicesDisplay();
                    }

                    this.value = '';
                }
            });



            // При нажатии Enter, добавляем текущий ввод немедленно
            servicesInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    // Очищаем таймаут, если он был
                    if (inputTimeout) {
                        clearTimeout(inputTimeout);
                        inputTimeout = null;
                    }

                    const inputValue = this.value.trim();
                    if (inputValue) {
                        const inputServices = inputValue.split(',').map(service => service.trim()).filter(service => service.length > 0);
                        let updated = false;

                        inputServices.forEach(service => {
                            if (service && !services.includes(service)) {
                                services.push(service);
                                updated = true;
                            }
                        });

                        if (updated) {
                            updateServicesDisplay();
                        }

                        this.value = '';
                    }
                }
            });



            //--------------------
            document.getElementById('proform').addEventListener('submit', function () {
                const input = document.getElementById('servicesInput');
                const tempValue = input.value.trim();

                // Добавляем оставшиеся услуги из поля ввода
                if (tempValue) {
                    const remaining = tempValue.split(',')
                        .map(s => s.trim())
                        .filter(s => s && !services.includes(s));

                    services.push(...remaining);
                }

                // Записываем все услуги в поле для отправки
                input.value = services.join(', ');
            });
            //--------------------




            // Обработчик кнопки для отображения результата
            testButton.addEventListener('click', function() {
                if (services.length > 0) {
                    servicesList.textContent = services.join(', ');
                    result.classList.remove('hidden');
                } else {
                    result.classList.add('hidden');
                }
            });

            // Инициализация
            updateServicesDisplay();
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


