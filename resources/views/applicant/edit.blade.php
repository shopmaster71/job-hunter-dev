@extends('layouts.app')
@section('title',  'Кабинет соискателя - Изменение личной информации')
@section('description', 'Изменение личной информации')
@section('body_class', 'bg-[#F5F6F8]')
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
                        <ul class="text-base lg:text-lg list-disc list-inside mt-4 lg:mt-9">
                            <li>Откликов на вакансии <b>– 10</b></li>
                            <li>Откликов от работодателей <b>– 20</b></li>
                            <li>Создано резюме <b>– 5</b></li>
                        </ul>
                    </div>
                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-applicant-component />
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 mt-3 lg:gap-6 lg:mt-6">
                    <div class=" bg-white rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение личной информации</h2>
                            <form action="{{ route('applicant.update', ['applicant' => $applicant->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-10">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Фамилия <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="surname" class="w-full block py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иванов" value="{{ $applicant->surname }}" />
                                                @if ($errors->has('surname'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('surname')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Имя <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иван" value="{{ $applicant->name }}" />
                                                @if ($errors->has('name'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('name')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Отчество</label>
                                            <div class="w-full md:w-5/8">
                                                <input type="text" name="patronymic" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Иванович" value="{{ $applicant->patronymic }}" />
                                                @if ($errors->has('patronymic'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('patronymic')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-1 md:gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Регион/Город</label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list"
                                                       placeholder="Начните вводить город"
                                                       value="{{ $applicant->city_name }}"
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
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Дата рождения <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="birth_date" class="block birtday w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="01.05.1995"  value="{{ $applicant->birth_date }}" />
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
                                                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="male" value="Мужской" @if($applicant->gender == 'Мужской') checked @endif />
                                                            <span class="absolute bg-green-primary w-2 h-2 rounded-full opacity-0 peer-checked:opacity-100
                                                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                                        </label>
                                                        <label class="ml-2 cursor-pointer text-base/4" for="male">Мужской</label>
                                                    </div>
                                                    <div class="flex items-center mt-3">
                                                        <label class="relative flex items-center cursor-pointer" for="female">
                                                            <input name="gender" type="radio" class="peer h-4 w-4 cursor-pointer appearance-none rounded-full
                                                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="female" value="Женский" @if($applicant->gender == 'Женский') checked @endif />
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
                                                    <option value="Российская Федерация"  @if($applicant->citizenship == 'Российская Федерация') selected @endif>Российская Федерация</option>
                                                    <option value="Узбекистан" @if($applicant->citizenship == 'Узбекистан') selected @endif>Узбекистан</option>
                                                    <option value="Такжикистан" @if($applicant->citizenship == 'Такжикистан') selected @endif>Такжикистан</option>
                                                    <option value="Молдова" @if($applicant->citizenship == 'Молдова') selected @endif>Молдова</option>
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
                                                    <option value="Среднее" @if($applicant->education == 'Среднее') selected @endif>Среднее</option>
                                                    <option value="Специальное" @if($applicant->education == 'Специальное') selected @endif>Специальное</option>
                                                    <option value="Высшее" @if($applicant->education == 'Высшее') selected @endif>Высшее</option>
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
                                                        <input type="checkbox" name="driving_licence" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="vu" value="1" @if($applicant->driving_licence) checked @endif />
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
                                                        <input type="checkbox" name="married" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="merried" value="1" @if($applicant->married) checked @endif />
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
                                                        <input type="checkbox" name="children" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="childs" value="1" @if($applicant->children) checked @endif />
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
                    </div>
                    </div>
                </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        document.getElementById('city').addEventListener('input', function () {
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




