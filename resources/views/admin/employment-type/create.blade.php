@extends('admin.layout.app')
@section('title',  'Справочник - Новый тип занятости')
@section('description', 'Справочник - Новый тип занятости')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Новый тип занятости</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employment-types.index') }}">Типы занятости</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новый тип занятости</li>
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
                        <form role="form" action="{{ route('employment-types.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="title" class="form-label">Тип занятости</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                       placeholder="Название"
                                        value="{{ old('title') }}">
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
