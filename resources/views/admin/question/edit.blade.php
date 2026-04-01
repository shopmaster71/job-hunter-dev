@extends('admin.layout.app')
@section('title', 'Админпанель - Редактирование вопроса-ответа')
@section('description', 'Админпанель - Редактирование вопроса-ответа')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Редактирование вопроса-ответа</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Вопросы и ответы</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Редактирование вопроса-ответа</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form role="form" action="{{ route('questions.update', ['question' => $question->id]) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-4 mg-col-12">
                            <label for="question" class="form-label">Вопрос <sup>*</sup></label>
                            <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" id="question"
                                   placeholder="Вопрос" value="{{ $question->question }}">
                                    @if ($errors->has('question'))
                                        <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                            {{ $errors->get('question')[0] }}
                                        </div>
                                    @endif
                        </div>
                        <div class="form-group mb-3 col-4 mg-col-12">
                            <label for="page_id" class="form-label">Страница <sup>*</sup></label>
                            <select class="form-select @error('page_id') is-invalid @enderror" id="page_id" name="page_id">
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}" {{ $question->page_id == $page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('page_id'))
                                <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                    {{ $errors->get('page_id')[0] }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3 col-8 mg-col-12">
                            <label class="form-label" for="answer">Ответ <sup>*</sup></label>
                            <textarea class="form-control" id="answer" name="answer" rows="5">{{ $question->answer }}</textarea>
                            @if ($errors->has('answer'))
                                <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                    {{ $errors->get('answer')[0] }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

