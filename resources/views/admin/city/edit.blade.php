@extends('admin.layout.app')
@section('title',  'Справочник - Изменение города/региона')
@section('description', 'Справочник - Изменение города/региона')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Изменение города/региона</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cities.index') }}">Города и районы</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Изменение города/региона</li>
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
                        <form role="form" action="{{ route('cities.update', ['city' => $city->id]) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="name" class="form-label">Город <sup>*</sup></label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror" id="name"
                                       placeholder="Название"
                                        value="{{ $city->name }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('name')[0] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="region" class="form-label">Регион <sup>*</sup></label>
                                <input type="text" name="region" class="form-control @error('region') is-invalid @enderror" id="region"
                                       placeholder="Название"
                                       value="{{ $city->region }}">
                                @if ($errors->has('region'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('region')[0] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="region_code" class="form-label">Код региона <sup>*</sup></label>
                                <input type="text" name="region_code" class="form-control @error('region_code') is-invalid @enderror" id="region_code"
                                       placeholder="MSK"
                                       value="{{ $city->region_code }}">
                                @if ($errors->has('region_code'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('region_code')[0] }}
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
