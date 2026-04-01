@extends('layouts.app')
@section('title',  'Кабинет работодателя - Новая вакансия')
@section('description', 'Кабинет работодателя - Новая вакансия')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
    <main class="main grow ">
        <section class="">
            <div class="container mx-auto">
                <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                    <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                        <h1 class="font-semibold text-lg md:text-3xl">Новая вакансия</h1>
                        <div class="mt-2 px-0 md:px-4">
                            <form action="{{ route('employer.vacancy.store') }}" method="post">
                                @csrf
                                <div class="mt-2 lg:mt-4 flex flex-col lg:flex-row gap-3 lg:gap-6">
                                    <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col gap-0 mb-0 lg:mb-5">
                                            <label class="w-full font-semibold text-base">Должность <sup class="text-red-500">*</sup></label>
                                            <input type="text" name="position" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Начальник транспортного цеха" value="{{ old('position') }}" />
                                            @if ($errors->has('position'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('position')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Отрасль <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields custom_select relative border-b border-[#cccccc] ">
                                                <select class="select_default block w-full py-1 text-blue-primary bg-transparent appearance-none focus:outline-none focus:ring-0 peer" name="industry_id">
                                                    @foreach($industries as $industryGroup)
                                                        <optgroup label="{{ $industryGroup->title }}">
                                                            @foreach($industryGroup->industries as $industry)
                                                                <option value="{{ $industry->id }}" {{ $employer->industry_id == $industry->id ? "selected":'' }}>{{ $industry->title }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('industry_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('industry_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Занятость <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="employment_type_id">
                                                    @foreach($employmentTypes as $employmentType)
                                                        <option value="{{ $employmentType->id }}" {{ old('employment_type_id') == $employmentType->id ? 'selected' : ''  }}>{{ $employmentType->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('employment_type_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('employment_type_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Опыт работы <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="expertise_id">
                                                    @foreach($expertises as $expertise)
                                                        <option value="{{ $expertise->id }}" {{ old('expertise_id') == $expertise->id ? 'selected' : ''  }}>{{ $expertise->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('expertise_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('expertise_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Организация <sup class="text-red-500">*</sup></label>
                                            <input type="text" name="organization" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="Организация" value="{{ $employer->title }}" />
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
                                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="10000" value="{{ old('salary_min') }}" />

                                                </div>
                                                <div class="w-full md:w-1/2">
                                                    <input type="text" name="salary_max" class="input-number block w-full py-1 bg-transparent border-b border-[#cccccc]
                                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="300000" value="{{ old('salary_max') }}" />
                                                </div>

                                            </div>
                                            <div class="flex mt-1.5 items-start">
                                                <label class="flex items-center cursor-pointer relative">
                                                    <input type="hidden" name="contractual" value="0">
                                                    <input type="checkbox" name="contractual" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="check1" value="1" {{ old('contractual') ? 'checked' : '' }} />
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
                                            <label class="w-full font-semibold text-base">Cпециализация <sup class="text-red-500">*</sup></label>
                                            <div class="w-full custom_select profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select_default block w-full py-1 text-blue-primary bg-transparent appearance-none focus:outline-none focus:ring-0 peer" name="specialization_id" >
                                                    @foreach($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}" {{ old('specialization_id') == $specialization->id ? 'selected' : ''  }}>{{ $specialization->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('specialization_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('specialization_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">График <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="schedule_id">
                                                    @foreach($schedules as $schedule)
                                                        <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : ''  }}>{{ $schedule->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('schedule_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('schedule_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Формат работы <sup class="text-red-500">*</sup></label>
                                            <div class="w-full profile-fields relative border-b border-[#cccccc] ">
                                                <select class="select block w-full new_select" name="format_id">
                                                    @foreach($formats as $format)
                                                        <option value="{{ $format->id }}" {{ old('format_id') == $format->id ? 'selected' : ''  }}>{{ $format->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('format_id'))
                                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('format_id')[0] }}</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-0">
                                            <label class="w-full font-semibold text-base">Город <sup class="text-red-500">*</sup></label>
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
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Адрес <sup class="text-red-500">*</sup></label>
                                    <input type="text" name="address" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" placeholder="Адрес" value="{{ $employer->address }}" />
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('address')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Обязанности <sup class="text-red-500">*</sup></label>
                                    <textarea rows="4" class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="charge" placeholder="Опишите обязанности работника">{{ old('charge') }}</textarea>
                                    @if ($errors->has('charge'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('charge')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Требования</label>
                                    <textarea rows="4"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="requirement" placeholder="Опишите требования к кандидату">{{ old('requirement') }}</textarea>
                                    @if ($errors->has('requirement'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('requirement')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Условия работы</label>
                                    <textarea rows="4"  class="block w-full py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                    appearance-none focus:outline-none focus:ring-0 peer" name="conditions" placeholder="Опишите условия работы">{{ old('conditions') }}</textarea>
                                    @if ($errors->has('conditions'))
                                        <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('conditions')[0] }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-0 mt-2">
                                    <label class="w-full font-semibold text-base text-blue-primary">Дополнительно</label>
                                    <div class="flex mt-3 items-start">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" name="additional[]" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="disabilities" value="disabilities" {{ in_array('disabilities', old('additional', [])) ? 'checked' : '' }} />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="cursor-pointer ml-2  text-base/4" for="disabilities">Для людей с инвалидностью</label>
                                    </div>
                                    <div class="flex mt-1.5 items-start">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" name="additional[]" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="moving" value="moving" {{ in_array('moving', old('additional', [])) ? 'checked' : '' }} />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="cursor-pointer ml-2  text-base/4" for="moving">С переездом</label>
                                    </div>
                                    <div class="flex mt-1.5 items-start">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" name="additional[]" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="students" value="students" {{ in_array('students', old('additional', [])) ? 'checked' : '' }} />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="cursor-pointer ml-2  text-base/4" for="students">Студентам</label>
                                    </div>
                                    <div class="flex mt-1.5 items-start">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" name="additional[]" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="pensioners" value="pensioners" {{ in_array('pensioners', old('additional', [])) ? 'checked' : '' }} />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="cursor-pointer ml-2  text-base/4" for="pensioners">Пенсионерам</label>
                                    </div>
                                    <div class="flex mt-1.5 items-start">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" name="additional[]" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="phone" value="phone" {{ in_array('phone', old('additional', [])) ? 'checked' : '' }} />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <label class="cursor-pointer ml-2  text-base/4" for="phone">С телефоном</label>
                                    </div>
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




