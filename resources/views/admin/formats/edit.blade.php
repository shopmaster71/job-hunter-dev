@extends('admin.layout.app')
@section('title',  'Справочник - Изменение формата работы')
@section('description', 'Справочник - Изменение формата работы')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Изменение формата работы</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('formats.index') }}">Формат работы</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Изменение формата работы</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form role="form" action="{{ route('formats.update', ['format' => $format->id]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="title" class="form-label">Формат работы</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                       placeholder="Формат работы"
                                        value="{{ $format->title }}">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('title')[0] }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
