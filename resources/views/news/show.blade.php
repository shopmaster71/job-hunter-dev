@extends('layouts.app')
@section('title',  $oneNew->title)
@section('description', $oneNew->title)
@section('body_class', 'bg-white')
@section('content')
    <main class="main grow ">
        <section class="bg-white">
            <div class="container mx-auto">
                <div class="flex flex-col lg:flex-row gap-3 lg:gap-12">
                    <div class="w-full lg:w-5/10">
                        <div class="pb-3 lg:pb-7 border-b border-[#cccccc]">
                            <h1 class="text-2xl md:text-3xl lg:text-[40px] font-bold">{{ $oneNew->title }}</h1>
                            @if($oneNew->subheading)
                            <p class="text-lg lg:text-2xl mt-1 lg:mt-5 pr-0 lg:pr-0">{{ $oneNew->title }}</p>
                            @else
                                <p class="text-lg lg:text-2xl mt-1 lg:mt-5 pr-0 lg:pr-0">{{ Str::limit($oneNew->content, 100) }}</p>
                            @endif
                        </div>
                        <div class="mt-5 lg:mt-10">
                            <p class="list-news-info text-[#53575C] flex flex-row justify-start text-base/4">
                                <span class="w-1/2 list-news-date">{{ $oneNew->created_at }}</span>
                                <span class="w-1/2 list-news-views relative pl-8">{{ $oneNew->views }}</span>
                            </p>
                        </div>
                        <div class="mt-3 lg:mt-6 flex justify-start flex-row gap-3 lg:gap-6 pb-3 lg:pb-8 border-b border-[#cccccc]">
                            <dl class="w-1/2 text-blue-primary">
                                <dt class="text-[#53575C]">Категория</dt>
                                <dd class="text-lg font-semibold">{{ $oneNew->getCategory->title }}</dd>
                            </dl>
                            @if($oneNew->source)
                            <dl class="w-1/2 text-blue-primary">
                                <dt class="text-[#53575C]">Источник</dt>
                                <dd class="text-base md:text-lg font-semibold"><a href="{{ $oneNew->source_url }}">{{ $oneNew->source }}</a></dd>
                            </dl>
                            @else
                                <dl class="w-1/2 text-blue-primary">
                                    <dt class="text-[#53575C]">Автор</dt>
                                    <dd class="text-base md:text-lg font-semibold">Константин Петров</dd>
                                </dl>
                            @endif
                        </div>
                    </div>
                    <div class="hidden lg:block w-full lg:w-5/10">
                        <img src="{{ asset($oneNew->image) }}" class="rounded-lg relative"  alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="py-6 lg:py-12 text-blue-primary text-base md:text-lg">
            <div class="container mx-auto">
                <div class="flex flex-col md:flex-row justify-start gap-6 w-full">
                    <div class="w-full md:w-2/3">
                        {!! $oneNew->content !!}
                    </div>
                    <div class="w-full md:w-1/3 flex flex-col gap-6 ">
                        @if(count($relatedNews))
                        <div class="py-4 px-7 bg-white rounded-lg shadow-lg">
                            <h4 class="text-blue-primary font-semibold text-xl lg:lg:text-2xl/6 mb-3">Похожие новости</h4>
                            <div class="list-last-news flex flex-col gap-5">
                                @foreach($relatedNews as $item)
                                    <div class="list-last-news-item pb-5 last:border-0 border-b border-[#cccccc]">
                                        <a href="{{ route('news.show', ['slug' => $item->slug]) }}">
                                            <p class="list-news-info text-[#53575C] opacity-50 flex flex-row justify-between text-[14px]/4">
                                                <span class="list-news-views relative pl-7">{{ $item->views }}</span>
                                                <span class="list-news-date">{{ $item->created_at }}</span>
                                            </p>
                                            <h5 class="text-blue-primary font-semibold text-lg/6 mt-3 lg:mt-5">{{ Str::limit($item->title, 28) }}</h5>
                                            <p class="text-blue-primary text-base/5 mt-1">{{ Str::limit($item->content, 60) }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="bg-white rounded-lg shadow-lg relative">
                            <a href="#">
                                <img src="{{ asset('assets/img/add-1.png') }}" alt="" class="relative rounded-lg">
                                <p class="text-blue-primary absolute top-10 left-10 bg-white px-4 py-3 rounded-lg text-center font-semibold text-2xl/6">Наша реклама</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

