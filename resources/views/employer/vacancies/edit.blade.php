@extends('layouts.app')
@section('title',  'Кабинет работодателя - Изменение вакансии '.$vacancy->position)
@section('description', 'Кабинет работодателя - Изменение вакансии '.$vacancy->position)
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="font-semibold text-lg md:text-3xl">Изменение вакансии {{ $vacancy->position }}</h1>
                        <div class="mt-2 px-0 md:px-4">
                            <form action="{{ route('employer.vacancy.update', ['vacancy' => $vacancy->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-6">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col gap-0 mb-0 lg:mb-5">
                                            <label class="w-full font-semibold text-base">Должность <sup class="text-red-500">*</sup></label>
                                            <input type="text" name="position" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Начальник транспортного цеха" value="{{ $vacancy->position }}" />
                                            @if ($errors->has('position'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('position')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Занятость <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="employment_type">
                                                    <option value="Полная" @if($vacancy->employment_type == 'Полная') selected @endif>Полная</option>
                                                    <option value="Частичная" @if($vacancy->employment_type == 'Частичная') selected @endif>Частичная</option>
                                                    <option value="Сменный график" @if($vacancy->employment_type == 'Сменный график') selected @endif>Сменный график</option>
                                                    <option value="Удалёнка" @if($vacancy->employment_type == 'Удалёнка') selected @endif>Удалёнка</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('employment_type'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('employment_type')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Опыт работы <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="experience">
                                                    <option value="От 1 года" @if($vacancy->experience == 'От 1 года') selected @endif>От 1 года</option>
                                                    <option value="От 3 лет" @if($vacancy->experience == 'От 3 лет') selected @endif>От 3 лет</option>
                                                    <option value="От 5 лет" @if($vacancy->experience == 'От 5 лет') selected @endif>От 5 лет</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('experience'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('experience')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Организация <sup class="text-red-500">*</sup></label>
                                            <input type="text" name="organization" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Организация" value="{{ $vacancy->organization }}" />
                                            @if ($errors->has('organization'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('organization')[0] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base text-blue-primary">Заработная плата, руб. <sup class="text-red-500">*</sup></label>
                                            <div class="flex flex-row gap-2">
                                                <div class="w-full md:w-1/2">
                                                    <input type="text" name="salary_min" class="input-number block w-full py-1 bg-transparent border-b border-[#cccccc]
                                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="10000" value="{{ $vacancy->salary_min }}" />

                                                </div>
                                                <div class="w-full md:w-1/2">
                                                    <input type="text" name="salary_max" class="input-number block w-full py-1 bg-transparent border-b border-[#cccccc]
                                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="300000" value="{{ $vacancy->salary_max }}" />
                                                </div>

                                            </div>
                                            <div class="flex mt-1.5 items-start">
                                                <label class="flex items-center cursor-pointer relative">
                                                    <input type="hidden" name="contractual" value="0">
                                                    <input type="checkbox" name="contractual" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="check1" value="1" {{ $vacancy->contractual ? 'checked' : '' }} />
                                                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer ml-2  text-sm/4" for="check1">По договорённости</label>
                                            </div>
                                            @if ($errors->has('salary_min'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('salary_min')[0] }}</div>
                                            @endif
                                            @if ($errors->has('contractual'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('contractual')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">График <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="schedule">
                                                    <option value="Пятидневка" @if($vacancy->schedule == 'Пятидневка') selected @endif>Пятидневка</option>
                                                    <option value="Сутки через трое" @if($vacancy->schedule == 'Сутки через трое') selected @endif>Сутки через трое</option>
                                                    <option value="Сменный график" @if($vacancy->schedule == 'Сменный график') selected @endif>Сменный график</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Формат работы <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="format">
                                                    <option value="В офисе" @if($vacancy->format == 'В офисе') selected @endif>В офисе</option>
                                                    <option value="На производстве" @if($vacancy->format == 'На производстве') selected @endif>На производстве</option>
                                                    <option value="На выезде" @if($vacancy->format == 'На выезде') selected @endif>На выезде</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Город <sup class="text-red-500">*</sup></label>
                                            <input type="text" name="city_name" id="city_name" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" list="cities-list"
                                                   placeholder="Начните вводить город"
                                                   value="{{ $vacancy->city_name }}"
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
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Адрес <sup class="text-red-500">*</sup></label>
                                    <input type="text" name="address" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="Адрес" value="{{ $vacancy->address }}" />
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('address')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Обязанности <sup class="text-red-500">*</sup></label>
                                    <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="charge" placeholder="Опишите обязанности работника">{{ $vacancy->charge }}</textarea>
                                    @if ($errors->has('charge'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('charge')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Требования</label>
                                    <textarea rows="4"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="requirement" placeholder="Опишите требования к кандидату">{{ $vacancy->requirement }}</textarea>
                                    @if ($errors->has('requirement'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('requirement')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Условия работы</label>
                                    <textarea rows="4"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="conditions" placeholder="Опишите условия работы">{{ $vacancy->conditions }}</textarea>
                                    @if ($errors->has('conditions'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('conditions')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Дополнительно</label>
                                    <textarea rows="4"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="additional" placeholder="Дополнительная информация по вакансии">{{ $vacancy->additional }}</textarea>
                                    @if ($errors->has('additional'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('additional')[0] }}</div>
                                    @endif
                                </div>
                                <div class="w-full mt-8">
                                    <button class="btn-utp-green inline-block  grow py-2.5 px-14 text-white text-base md:text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                        <x-employer-component />
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


