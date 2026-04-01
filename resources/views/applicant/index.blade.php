@extends('layouts.app')
@section('title',  'Кабинет соискателя')
@section('description', 'Кабинет соискателя')
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
                        <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Личный кабинет соискателя</h1>
                        <div class="subscribe mt-3 lg:mt-6">
                            <h5 class="font-semibold text-lg lg:text-2xl">Оформите подписку</h5>
                            <ul class="text-base lg:text-lg list-disc list-inside mt-2 lg:mt-6">
                                <li>Первым узнаете о вакансии</li>
                                <li>Повысит  эффективность поиска работы на 50%</li>
                            </ul>
                            <div class="w-full mt-4 lg:mt-9 py-3">
                                <a href="#" class="btn-utp-green inline w-full grow py-3 px-6 text-white text-base:text-lg bg-green-primary border border-solid border-green-primary rounded-4xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out">Оформить подписку</a>
                            </div>
                        </div>
                        <x-counts-applicant />
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
                        <x-applicant-component />

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
                        @if(!$applicant)
                            <form action="{{ route('applicant.create') }}" method="post">
                                @csrf
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Фамилия <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="surname" class="w-full block py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иванов" value="{{ old('surname') }}" />
                                                @if ($errors->has('surname'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('surname')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Имя <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иван" value="{{ old('name') }}" />
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('name')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Отчество</label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="patronymic" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иванович" value="{{ old('patronymic') }}" />
                                                @if ($errors->has('patronymic'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('patronymic')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Регион/Город <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list"
                                                       placeholder="Начните вводить город"
                                                       value="{{ old('city_name', $applicant?->city?->name) }}"
                                                       autocomplete="off">
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
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Дата рождения <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="birth_date" class="block birtday w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="гггг-мм-дд"  value="{{ old('birth_date') }}" />
                                                @if ($errors->has('birth_date'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('birth_date')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Пол <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <div>
                                                    <div class="flex items-center">
                                                        <label class="relative flex items-center cursor-pointer" for="male">
                                                            <input name="gender" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                                                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="male" value="Мужской">
                                                            <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                                                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                                        </label>
                                                        <label class="ml-2 cursor-pointer text-base/4" for="male">Мужской</label>
                                                    </div>
                                                    <div class="flex items-center mt-3">
                                                        <label class="relative flex items-center cursor-pointer" for="female">
                                                            <input name="gender" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                                                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="female" value="Женский">
                                                            <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                                                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                                        </label>
                                                        <label class="ml-2 cursor-pointer text-base/4" for="female">Женский</label>
                                                    </div>
                                                    @if ($errors->has('gender'))
                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('gender')[0] }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Гражданство <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="citizenship">
                                                    <option value="Российская Федерация" selected>Российская Федерация</option>
                                                    <option value="Узбекистан">Узбекистан</option>
                                                    <option value="Такжикистан">Такжикистан</option>
                                                    <option value="Молдова">Молдова</option>
                                                </select>
                                                @if ($errors->has('citizenship'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('citizenship')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Образование <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="education">
                                                    <option value="Среднее" selected>Среднее</option>
                                                    <option value="Специальное">Специальное</option>
                                                    <option value="Высшее">Высшее</option>
                                                </select>
                                                @if ($errors->has('education'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('education')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Дополнительно</label>
                                            <div class="w-full md:w-5/8">
                                                <div class="flex items-start mt-1 lg:mt-3">
                                                    <label class="flex items-center cursor-pointer relative">
                                                        <input type="checkbox" name="driving_licence" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="vu" value="1" />
                                                        <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                    </label>
                                                    <label class="cursor-pointer ml-2 text-base/3" for="vu">Есть водительское удостоверение</label>
                                                </div>
                                                <div class="flex items-start mt-1 lg:mt-3">
                                                    <label class="flex items-center cursor-pointer relative">
                                                        <input type="checkbox" name="married" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="merried" value="1" />
                                                        <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                    </label>
                                                    <label class="cursor-pointer ml-2 text-base/3" for="merried">Состою в браке</label>
                                                </div>
                                                <div class="flex items-start mt-1 lg:mt-3">
                                                    <label class="flex items-center cursor-pointer relative">
                                                        <input type="checkbox" name="children" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="childs" value="1" />
                                                        <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                    </label>
                                                    <label class="cursor-pointer ml-2 text-base/3" for="childs">Есть дети</label>
                                                </div>
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
                                <li class="bg-gray-50 py-2 px-3"><b>Имя:</b> {{ $applicant->name }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Фамилия:</b> {{ $applicant->surname }}</li>
                                @if($applicant->patronymic)
                                    <li class="bg-gray-50 py-2 px-3"><b>Отчество:</b> {{ $applicant->patronymic }}</li>
                                @endif
                                <li class="bg-gray-50 py-2 px-3"><b>Регион/город:</b> {{ $applicant->city_name }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Дата рождения:</b> {{ $applicant->birth_date }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Пол:</b> {{ $applicant->gender }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Гражданство:</b> {{ $applicant->citizenship }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>Образование:</b> {{ $applicant->education }}</li>
                                @if($applicant->driving_licence)
                                    <li class="bg-gray-50 py-2 px-3">Есть водительское удостоверение</li>
                                @endif
                                @if($applicant->married)
                                    @if($applicant->gender == 'Мужской')
                                        <li class="bg-gray-50 py-2 px-3">Женат</li>
                                    @else
                                        <li class="bg-gray-50 py-2 px-3">Замужем</li>
                                    @endif
                                @endif
                                @if($applicant->children)
                                    <li class="bg-gray-50 py-2 px-3">Есть дети</li>
                                @endif
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('applicant.edit', ['applicant' => $applicant->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif

                    </div>
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Контакты</h2>
                        @if(!$contact)
                        <form action="{{ route('applicant.contact.create') }}" method="post">
                            @csrf
                            <div class="mt-2 md:mt-4 flex flex-col md:flex-row gap-3 md:gap-10">
                                <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Телефон <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 relative">
                                            <input type="text" name="phone" class="phone block py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="+7(999)888-77-66" value="{{ old('phone') }}" />
                                            @if ($errors->has('phone'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('phone')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">E-mail <sup class="text-red-500">*</sup></label>
                                        <div class="w-full md:w-5/8 relative">
                                            <input type="email" name="email" class="block w-full md:w-5/8 py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="example@mail.com" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">VK</label>
                                        <div class="w-full md:w-5/8">
                                            <input type="text" name="vk" class="block w-full  py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://vk.com/my-profile" value="{{ old('vk') }}" />
                                            <div class="flex items-start mt-2">
                                                <label class="flex items-center cursor-pointer relative">
                                                    <input type="checkbox" name="vk_check" class="peer h-3 w-3 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="vkc" value="1" />
                                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer ml-2 text-[#53575C] text-sm/3" for="vkc">Показывать работодателям</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-2">
                                        <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Telegram</label>
                                        <div class="w-full md:w-5/8">
                                            <input type="text" name="telegram" class="block w-full  py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://tg.me/my-profile" value="{{ old('telegram') }}" />
                                            <div class="flex items-start mt-2">
                                                <label class="flex items-center cursor-pointer relative">
                                                    <input type="checkbox" name="telegram_check" class="peer h-3 w-3 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="tgc" value="1" />
                                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer ml-2 text-[#53575C] text-sm/3" for="tgc">Показывать работодателям</label>
                                            </div>
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
                                <li class="bg-gray-50 py-2 px-3"><b>Телефон:</b> {{ $contact->phone }}</li>
                                <li class="bg-gray-50 py-2 px-3"><b>E-mail:</b> {{ $contact->email }}</li>
                                @if($contact->vk)
                                    <li class="bg-gray-50 py-2 px-3">
                                        <b>VK:</b> {{ $contact->vk }}
                                        @if($contact->vk_check)
                                            <br/><small>Показывать работодателю</small>
                                        @endif
                                    </li>
                                @endif
                                @if($contact->telegram)
                                    <li class="bg-gray-50 py-2 px-3">
                                        <b>Telegram:</b> {{ $contact->telegram }}
                                        @if($contact->telegram_check)
                                            <br/><small>Показывать работодателю</small>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('applicant.contact.edit', ['applicant' => $applicant->id]) }}" class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none">Изменить</a>
                            </div>
                        @endif
                    </div>
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Информация о прошлых местах работы</h2>
                        <div class="mt-0">
                            @if(count($experiences))
                                @foreach($experiences as $experience)
                                    <div class="relative md:mt-5 pt-1 pb-3 md:pb-8 last:border-0 border-b border-b-[#cccccc] pr-10">
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
                                <p class="mt-2">Места работы не найдены</p>
                            @endif
                        </div>
                    </div>
                    <div class="profile-forms-item bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Список образовательных учреждения</h2>
                        @if(count($educations))
                            <div class="mt-0">
                                @foreach($educations as $education)
                                    <div class="mt-2 md:mt-5 pt-1 pb-3 md:pb-8 last:border-0 border-b border-b-[#cccccc]">
                                        <dl class="">
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
                            </div>
                        @else
                            <p class="mt-2">Учебных заведений не найдено</p>
                        @endif
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

