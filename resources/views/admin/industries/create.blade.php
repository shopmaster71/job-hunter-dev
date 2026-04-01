@extends('admin.layout.app')
@section('title',  'Справочник - Новая отрасль')
@section('description', 'Справочник - Новая отрасль')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Новая отрасль</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('industries.index') }}">Отрасли</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новая отрасль</li>
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
                        <form role="form" action="{{ route('industries.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="group_industries_id" class="form-label">Группа отраслей <sup>*</sup></label>
                                <select class="form-select @error('group_industries_id') is-invalid @enderror" id="group_industries_id" name="group_industries_id">
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ old('group_industries_id') == $group->id ? 'selected' : '' }}>{{ $group->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_industries_id'))
                                    <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                        {{ $errors->get('group_industries_id')[0] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3 col-6 mg-col-12 ">
                                <label for="title" class="form-label">Отрасль <sup>*</sup></label>
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
