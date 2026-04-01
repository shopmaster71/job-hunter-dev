@extends('layouts.app')
@section('title',  $page->title)
@section('description', $page->title)
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow">
        @if($page->id == 1)
            {!! $page->content !!}
        @else
            <section class="questions bg-white py-5">
                <div class="container mx-auto">
                    <h1 class="text-2xl md:text-3xl lg:text-[40px] font-bold mb-2">{{ $page->title }}</h1>
                    {!! $page->content !!}
                </div>
            </section>
        @endif

        @if(count($page->getQuestions))
            <section class="questions bg-white py-5 md:py-10 lg:py-15">
                <div class="container mx-auto">
                    <div class="accordion-wrapper w-full max-w-3xl mx-auto">
                        <h2 class="font-semibold text-xl md:text-2xl lg:text-[40px] text-blue-primary">Вопросы</h2>
                        <ul class="accordion w-full mt-3 lg:mt-5">
                            @foreach($page->getQuestions as $question)
                                <li class="relative mb-2 lg:mb-5 border-b-2 border-[#CCCCCC]">
                                    <a class="text-blue-primary text-lg md:text-xl block w-full h-full cursor-pointer relative py-4 pl-3 pr-5">{{ $question->question }}
                                        <div class="accordion-mark">
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <p class="text-blue-primary hidden mb-3 pl-3 pr-5">{{ $question->answer }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
