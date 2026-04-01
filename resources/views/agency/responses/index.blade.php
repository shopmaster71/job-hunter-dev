@extends('layouts.app')
@section('title',  'Отклики на вакансии')
@section('description', 'Отклики на вакансии')
@section('body_class', 'bg-[#F5F6F8]')
@section('content')
<main class="main grow ">
    <section class="">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse items-start lg:flex-row justify-start gap-3 lg:gap-6 w-full">
                <div class="w-full lg:w-2/3 bg-white  rounded-lg shadow-lg py-5 px-5 lg:py-10 lg:px-10">
                    <h1 class="text-2xl/7 lg:text-3xl/8 font-bold">Отклики на вакансии</h1>
                    <div class="mt-3 lg:mt-6">
                        @if(count($responses))
                            <div class="w-full overflow-x-auto">
                                <table class="min-w-full table-auto border-separate border-spacing-0 bg-white text-blue-primary">
                                    <thead class="font-semibold text-base md:text-lg">
                                        <tr>
                                            <th class="text-left px-4 py-3 border border-gray-300">Должность</th>
                                            <th class="text-left px-4 py-3 border border-gray-300">Организация</th>
                                            <th class="text-left px-4 py-3 border border-gray-300">Отправлено</th>
                                            <th class="text-left px-4 py-3 border border-gray-300"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-base md:text-lg divide-y divide-gray-300">
                                        @foreach($responses as $response)
                                            <tr class="hover:bg-gray-50 @if($response->status == 0) bg-gray-100 @endif">
                                                <td class="px-4 py-3 border border-gray-300">{{ $response->position }}</td>
                                                <td class="px-4 py-3 border border-gray-300">{{ $response->organization }}</td>
                                                <td class="px-4 py-3 border border-gray-300">{{ $response->created_at }}</td>
                                                <td class="px-4 py-3 border border-gray-300 ">
                                                    <a href="{{ route('agency.response.show', ['response' => $response->id]) }}" class="text-gray-500 hover:text-yellow-600 transition">
                                                        <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M25.7761 8.38456C23.8887 10.3705 22.2373 11.9505 20.2211 13.4128C16.6467 16.0073 12.6524 16.8518 8.38714 15.0143C5.12937 13.6154 2.40959 11.4731 0.353416 8.67654C-0.0145506 8.1776 -0.163641 7.98233 0.239219 7.47107C3.13029 3.79861 6.64691 0.865948 11.5732 0.121848C14.8608 -0.375245 17.8705 0.702099 20.3917 2.59684C22.3584 4.07519 23.9921 5.64654 25.8129 7.55607C26.0603 7.79692 26.0724 8.07596 25.7761 8.38456ZM2.35503 7.5222C2.24037 7.65016 2.1769 7.81388 2.17621 7.98349C2.17551 8.1531 2.23762 8.31731 2.35122 8.44616C4.26147 10.5984 6.42042 12.3632 9.08627 13.4972C10.9775 14.2979 12.9531 14.5875 14.9801 14.0516C18.4694 13.1276 21.0985 11.0148 23.4268 8.42953C23.5335 8.31094 23.5927 8.15898 23.5934 8.0015C23.5941 7.84402 23.5363 7.69157 23.4306 7.57209C21.5102 5.40939 19.3475 3.62984 16.6677 2.48782C13.9878 1.34579 11.334 1.44066 8.6961 2.66152C6.21931 3.80539 4.19549 5.48208 2.35503 7.52404V7.5222Z" fill="currentColor"/>
                                                            <path d="M12.8313 12.9195C9.98587 12.8992 7.76412 10.6786 7.80726 7.89804C7.84976 5.17912 10.1096 3.04476 12.9252 3.06509C15.7706 3.08541 17.9923 5.30601 17.9485 8.08653C17.9067 10.8055 15.6468 12.9398 12.8313 12.9195ZM12.8598 11.2976C14.6996 11.3093 16.2679 9.80264 16.28 8.01015C16.2921 6.21765 14.7415 4.69866 12.8966 4.68695C11.0517 4.67525 9.48848 6.18193 9.47643 7.97442C9.46438 9.76691 11.0149 11.2859 12.8598 11.2976Z" fill="currentColor"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Откликов на вакансии не найдено..</p>
                        @endif
                    </div>
                </div>
                <div class="w-full mt-4 lg:mt-0 lg:w-1/3 py-5 px-5 lg:py-8 lg:px-7 xl:px-10 bg-white rounded-lg shadow-lg">
                    <x-agency-component />
                </div>
            </div>
</div>
    </section>
</main>
@endsection
