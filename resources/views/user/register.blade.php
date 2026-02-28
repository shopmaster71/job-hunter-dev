@extends('layouts.app-login')
@section('title',  'Регистрация')
@section('content')
    <div class="h-full w-full lg:w-1/2 flex justify-center lg:justify-start items-center bg-white py-3 lg:py-0 pl-3 lg:pl-30 pr-3 lg:pr-5">
        <div class="w-full max-w-[408px]">
                <h2 class="font-semibold text-xl md:text-2xl lg:text-3xl">Регистрация</h2>
                {{--<p class="mt-1 lg:mt-3"><a href="#" class="underline">Забыли пароль?</a></p>--}}
                <div class="mt-3 lg:mt-13">
                    <form action="{{ route('register') }}" method="post" id="form">
                        @csrf
                        <div>
                            <label class="text-lg font-medium" for="">Я регистрируюсь как <sup class="text-red-500">*</sup></label>
                            <div class="flex items-center mt-1 lg:mt-3">
                                <label class="relative flex items-center cursor-pointer" for="applicant">
                                    <input name="role" type="radio" value="1" class="peer h-4 w-4 lg:h-5 lg:w-5 cursor-pointer appearance-none rounded-full
                            border border-[#cccccc] checked:border-[#cccccc] transition-all" id="applicant">
                                    <span class="absolute bg-green-primary w-2 h-2 lg:w-3 lg:h-3 rounded-full opacity-0 peer-checked:opacity-100
                            transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 cursor-pointer text-base lg:text-lg" for="applicant">Соискатель</label>
                            </div>
                            <div class="flex items-center mt-1 lg:mt-3">
                                <label class="relative flex items-center cursor-pointer" for="employer">
                                    <input name="role" type="radio" value="2" class="peer h-4 w-4 lg:h-5 lg:w-5 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="employer">
                                    <span class="absolute bg-green-primary w-2 h-2 lg:w-3 lg:h-3 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 cursor-pointer text-base lg:text-lg" for="employer">Работодатель</label>
                            </div>
                            <div class="flex items-center mt-1 lg:mt-3">
                                <label class="relative flex items-center cursor-pointer" for="agency">
                                    <input name="role" type="radio" value="3" class="peer h-4 w-4 lg:h-5 lg:w-5 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="agency">
                                    <span class="absolute bg-green-primary w-2 h-2 lg:w-3 lg:h-3 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 cursor-pointer text-base lg:text-lg" for="agency">Кадровое агентство</label>
                            </div>
                            <div class="flex items-center mt-1 lg:mt-3">
                                <label class="relative flex items-center cursor-pointer" for="hr">
                                    <input name="role" type="radio" value="4" class="peer h-4 w-4 lg:h-5 lg:w-5 cursor-pointer appearance-none rounded-full
                        border border-[#cccccc] checked:border-[#cccccc] transition-all" id="hr">
                                    <span class="absolute bg-green-primary w-2 h-2 lg:w-3 lg:h-3 rounded-full opacity-0 peer-checked:opacity-100
                        transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                                </label>
                                <label class="ml-2 cursor-pointer text-base lg:text-lg" for="hr">HR</label>
                            </div>
                            @if ($errors->has('role'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('role')[0] }}</div>
                            @endif
                        </div>
                        <div class="my-3 lg:my-6">
                        <div class="relative">
                            <input type="text" id="email" name="email"
                                   class="block w-full px-2 py-2 text-blue-primary bg-transparent border-0 border-b-2 border-[#cccccc]
                    appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " />
                            <label for="email" class="absolute text-lg  duration-300 transform -translate-y-8 scale-75
                    top-3.5 z-10  left-2 peer-focus:start-0 peer-focus:text-[#cccccc] peer-placeholder-shown:scale-100
                    peer-placeholder-shown:-translate-y-1.5 peer-focus:scale-75 peer-focus:-translate-y-8">Email <sup class="text-red-500">*</sup>
                            </label>
                        </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                            @endif
                        </div>
                        <div  class="my-3 lg:my-6">
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                   class="block w-full px-2 py-2 text-blue-primary bg-transparent border-0 border-b-2 border-[#cccccc]
                    appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " />
                            <label for="password" class="absolute text-lg  duration-300 transform -translate-y-8 scale-75
                    top-3.5 z-10  left-2 peer-focus:start-0 peer-focus:text-[#cccccc] peer-placeholder-shown:scale-100
                    peer-placeholder-shown:-translate-y-1.5 peer-focus:scale-75 peer-focus:-translate-y-8">Пароль <sup class="text-red-500">*</sup>
                            </label>
                        </div>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('password')[0] }}</div>
                            @endif
                        </div>
                        <div class="my-3 lg:my-6">
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="block w-full px-2 py-2 text-blue-primary bg-transparent border-0 border-b-2 border-[#cccccc]
                    appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " />
                            <label for="password_confirmation" class="absolute text-lg  duration-300 transform -translate-y-8 scale-75
                    top-3.5 z-10  left-2 peer-focus:start-0 peer-focus:text-[#cccccc] peer-placeholder-shown:scale-100
                    peer-placeholder-shown:-translate-y-1.5 peer-focus:scale-75 peer-focus:-translate-y-8">Повторите пароль <sup class="text-red-500">*</sup>
                            </label>
                        </div>
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('password_confirmation')[0] }}</div>
                            @endif
                        </div>
                        <div class="flex mt-3 mb-3 lg:mt-6 items-start">
                            <label class="flex items-center cursor-pointer relative">
                                <input type="checkbox" class="peer h-4 w-4 cursor-pointer transition-all appearance-none rounded hover:shadow-md border border-[#cccccc] checked:bg-green-primary checked:border-green-primary" id="check1" />
                                <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                      </span>
                            </label>
                            <label class="cursor-pointer ml-2 text-[#cccccc] text-sm/4" for="check1">При входе и регистрации я даю согласие на обработку своих персональных данных в соответствии с <a href="#" class="underline">политикой обработки персональных данных</a></label>
                        </div>
                        <x-yandex-captcha />
                        <div class="utp-form-button w-full lg:w-5/8 mt-3 lg:mt-8">
                            <button onsubmit="handleSubmit()" class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




@endsection
