@extends('layouts.app-login')
@section('title',  'Восстановление пароля')
@section('content')
    <div class="h-full w-full lg:w-1/2 flex justify-center lg:justify-start items-center bg-white py-3 lg:py-0 pl-3 lg:pl-30 pr-3 lg:pr-5">
        <div class=" text-blue-primary  w-full max-w-[408px]">
            <h2 class="font-semibold text-xl md:text-2xl lg:text-3xl">Восстановление пароля</h2>
            <p class="mt-1 lg:mt-3">Пожалуйста, введите ваш адрес электронной почты, на который мы отправим ссылку для восстановления
                пароля</p>
            <div class="mt-3 lg:mt-13">
                <form action="{{ route('forgot') }}" method="post">
                    @csrf
                    <div class="my-3 lg:my-6">
                        <div class="relative">
                            <input type="email" id="email" name="email"
                               class="block w-full px-2 py-2 text-blue-primary bg-transparent border-0 border-b-2 border-[#cccccc]
                                appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required />
                            <label for="email" class="absolute text-lg text-blue-primary duration-300 transform -translate-y-8 scale-75
                            top-3.5 z-10  left-2 peer-focus:start-0 peer-focus:text-[#cccccc] peer-placeholder-shown:scale-100
                            peer-placeholder-shown:-translate-y-1.5 peer-focus:scale-75 peer-focus:-translate-y-8">Email <sup class="text-red-500">*</sup>
                            </label>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</div>
                        @endif
                    </div>
                    <div class="utp-form-button w-full lg:w-5/8 mt-5 lg:mt-12">
                        <button class="btn-utp-green block w-full grow py-2.5 px-2 text-white text-lg bg-green-primary border border-solid border-green-primary rounded-3xl hover:bg-green-primary-hover hover:border-green-primary-hover cursor-pointer transition duration-150 ease-in-out outline-none" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
