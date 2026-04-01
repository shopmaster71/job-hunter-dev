@extends('admin.layout.app')
@section('title',  'Справочник - Новая специализация')
@section('description', 'Справочник - Новая специализация')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Новая специализация</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('specializations.index') }}">Специализации</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новая специализация</li>
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
                        <form role="form" action="{{ route('specializations.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="industry_id" class="form-label">Отрасль</label>
                                <select class="form-select @error('industry_id') is-invalid @enderror" id="industry_id" name="industry_id">
                                    @foreach($industries as $industryGroup)
                                        <optgroup label="{{ $industryGroup->title }}">
                                            @foreach($industryGroup->industries as $industry)
                                                <option value="{{ $industry->id }}" {{ old('industry_id') == $industry->id ? 'selected' : '' }}>{{ $industry->title }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @if ($errors->has('industry_id'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('industry_id')[0] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="title" class="form-label">Специализация</label>
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
