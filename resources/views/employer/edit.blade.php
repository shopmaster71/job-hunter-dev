@extends('layouts.app')
@section('title',  'Кабинет работодателя')
@section('description', 'Кабинет работодателя')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white h-full rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Личный кабинет работодателя</h1>
                        <div class="subscribe mt-3 lg:mt-6">
                            <h5 class="font-semibold text-lg lg:text-2xl">Закажите продвижение Вашего профиля</h5>
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
                        <x-employer-component />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение информации о компании</h2>
                            <form action="{{ route('employer.update', ['employer' => $employer->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Сохраняем старые изображения, если новые не загружены -->
                                <input type="hidden" name="keep_old_images" value="1">

                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg">Название <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="title" class="block w-full  bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Электросбыт" value="{{ $employer->title }}" />
                                                @if ($errors->has('title'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('title')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Отрасль <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="sector">
                                                    <option value="1" @if($employer->sector == 1) selected @endif>Медицина</option>
                                                    <option value="2" @if($employer->sector == 2) selected @endif>Строительство</option>
                                                    <option value="3" @if($employer->sector == 3) selected @endif>Производство</option>
                                                    <option value="4" @if($employer->sector == 4) selected @endif>Сельское хозяйство</option>
                                                    <option value="5" @if($employer->sector == 4) selected @endif>Бытовые услуги</option>
                                                </select>
                                                @if ($errors->has('sector'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('sector')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Регион/Город <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1" id="regions">
                                                <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list"
                                                       placeholder="Начните вводить город"
                                                       value="{{ $employer->city_name }}"
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
                                            <label class="w-full md:w-3/8 text-base md:text-lg">Адрес компании <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                                <input type="text" name="address" class="block w-full bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Адрес компании" value="{{ $employer->address }}"  />
                                                @if ($errors->has('address'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('address')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg">О компании <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 py-1">
                                            <textarea rows="4"  class="block w-full bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" name="about" placeholder="Расскажите о Вашей компании">{{ $employer->about }}</textarea>
                                                @if ($errors->has('about'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('about')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ... внутри формы, после поля file-input ... -->
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg">Галерея<br/>
                                                <span class="text-gray-500 text-sm/3">Не более 3 шт.</span>
                                            </label>
                                            <div class="w-full md:w-5/8">
                                                <!-- Превью существующих изображений -->
                                                <div id="current-gallery" class="flex flex-wrap gap-2 mb-4">
                                                    @if($employer->gallery)
                                                        @foreach(json_decode($employer->gallery) as $image)
                                                            <div class="relative group">
                                                                <img src="{{ asset($image) }}" alt="Галерея" class="w-20 h-20 object-cover rounded" data-static>
                                                                {{--<button type="button" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xs opacity-1 group-hover:opacity-100 transition-opacity duration-200">Удалить</button>--}}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <!-- Загрузка новых файлов -->
                                                <div class="inline-flex flex-col items-start overflow-hidden">
                                                    <label id="file-label" class="inline-flex items-center pr-2 font-medium text-lg text-[#8F8F8F] focus:outline-none cursor-pointer">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.8287 7.7574L9.1718 13.4142C8.78127 13.8047 8.78127 14.4379 9.1718 14.8284C9.56232 15.219 10.1955 15.219 10.586 14.8284L16.2429 9.17161C17.4144 8.00004 17.4144 6.10055 16.2429 4.92897C15.0713 3.7574 13.1718 3.7574 12.0002 4.92897L6.34337 10.5858C4.39075 12.5384 4.39075 15.7042 6.34337 17.6569C8.29599 19.6095 11.4618 19.6095 13.4144 17.6569L19.0713 12L20.4855 13.4142L14.8287 19.0711C12.095 21.8047 7.66283 21.8047 4.92916 19.0711C2.19549 16.3374 2.19549 11.9053 4.92916 9.17161L10.586 3.51476C12.5386 1.56214 15.7045 1.56214 17.6571 3.51476C19.6097 5.46738 19.6097 8.6332 17.6571 10.5858L12.0002 16.2427C10.8287 17.4142 8.92916 17.4142 7.75759 16.2427C6.58601 15.0711 6.58601 13.1716 7.75759 12L13.4144 6.34319L14.8287 7.7574Z" fill="#0B2641"/>
                                                        </svg>
                                                        Прикрепите фото
                                                        <input type="file" id="file-input" name="gallery[]" class="hidden" accept="image/*" multiple />
                                                    </label>
                                                    <span id="file-name" class="mt-2 text-sm text-gray-600 hidden"></span>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="flex items-center">
                                                        <input type="checkbox" name="clear_gallery" value="1" class="mr-2">
                                                        <span class="text-sm">Удалить все изображения</span>
                                                    </label>
                                                </div>
                                                @if ($errors->has('gallery'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('gallery')[0] }}</div>
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
    <script>
        document.getElementById('file-input').addEventListener('change', function () {
            const files = this.files;
            const fileNameSpan = document.getElementById('file-name');

            if (files.length > 0) {
                fileNameSpan.innerHTML = '';
                Array.from(files).forEach((file, index) => {
                    const textNode = document.createTextNode(file.name);
                    fileNameSpan.appendChild(textNode);
                    if (index < files.length - 1) {
                        fileNameSpan.appendChild(document.createElement('br'));
                    }
                });

                fileNameSpan.classList.remove('hidden');
            } else {
                fileNameSpan.classList.add('hidden');
            }
        });
    </script>
    <script>
        document.getElementById('file-input').addEventListener('change', function () {
            const files = this.files;
            const previewContainer = document.getElementById('current-gallery');
            const fileNameSpan = document.getElementById('file-name');

            // Очищаем только новые превью (не трогаем старые изображения)
            Array.from(previewContainer.children).forEach(child => {
                if (!child.dataset.static) {
                    child.remove();
                }
            });

            if (files.length > 0) {
                fileNameSpan.textContent = `${files.length} файл(а) выбрано`;
                fileNameSpan.classList.remove('hidden');

                // Добавляем превью новых файлов
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                        <img src="${e.target.result}" alt="Новое изображение" class="w-20 h-15 object-cover rounded">
                        <button type="button" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200">Удалить</button>
                    `;
                        div.querySelector('button').onclick = () => div.remove();
                        previewContainer.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                fileNameSpan.classList.add('hidden');
            }
        });


        document.getElementById('file-input').addEventListener('change', function(e) {
            if (this.files.length > 3) {
                alert('Можно загрузить не более 3 изображений.');
                this.value = '';
                document.getElementById('file-name').classList.add('hidden');
                return false;
            }
        });
    </script>

@endpush

