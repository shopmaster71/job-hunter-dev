@extends('layouts.app')
@section('title',  'Кабинет соискателя - Изменение контактной информации')
@section('description', 'Изменение контактной информации')
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
                        <h2 class="font-semibold text-lg md:text-2xl/6">Изменение контактной информации</h2>
                            <form action="{{ route('applicant.contact.update', ['applicant' => $applicant->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mt-2 md:mt-4 flex flex-col md:flex-row gap-3 md:gap-10">
                                    <div class="w-full md:w-1/2 flex flex-col gap-4 mt-2">
                                        <div class="flex flex-col md:flex-row gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">Телефон <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="text" name="phone" class="phone block py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="+7(999)888-77-66" value="{{ $applicant->getContact->phone }}" />
                                                @if ($errors->has('phone'))
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('phone')[0] }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-2">
                                            <label class="w-full md:w-3/8 text-base md:text-lg text-blue-primary">E-mail <sup class="text-red-500">*</sup></label>
                                            <div class="w-full md:w-5/8 relative">
                                                <input type="email" name="email" class="block w-full md:w-5/8 py-1 text-blue-primary bg-transparent border-b border-[#cccccc]
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="example@mail.com" value="{{ $applicant->getContact->email }}" />
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://vk.com/my-profile" value="{{ $applicant->getContact->vk }}" />
                                                <div class="flex items-start mt-2">
                                                    <label class="flex items-center cursor-pointer relative">
                                                        <input type="checkbox" name="vk_check" class="peer h-3 w-3 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="vkc" value="1" @if($applicant->getContact->vk_check) checked @endif />
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
                                            appearance-none focus:outline-none focus:ring-0 peer" placeholder="https://tg.me/my-profile" value="{{ $applicant->getContact->telegram }}" />
                                                <div class="flex items-start mt-2">
                                                    <label class="flex items-center cursor-pointer relative">
                                                        <input type="checkbox" name="telegram_check" class="peer h-3 w-3 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="tgc" value="1" @if($applicant->getContact->telegram_check) checked @endif />
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

                    </div>
                </div>
        </section>
    </main>
@endsection


