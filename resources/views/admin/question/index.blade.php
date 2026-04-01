@extends('admin.layout.app')
@section('title',  'Админпанель - Вопросы и ответы')
@section('description', 'Админпанель - Вопросы и ответы')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Вопросы и ответы</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Вопросы и ответы</li>
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
                        <div class="d-md-flex">
                            <div class="text-end upgrade-btn">
                                <a href="{{ route('questions.create') }}" class="btn btn-success d-none d-md-inline-block text-white">Создать</a>
                            </div>
                        </div>
                        @if(count($questions))
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Страница</th>
                                        <th class="border-top-0">Вопрос</th>
                                        <th class="border-top-0">Дата публикации</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questions as $question)
                                        <tr>
                                            <td class="align-middle">{{ $question->getPage->title }}</td>
                                            <td class="align-middle">{{ $question->question }}</td>
                                            <td class="align-middle">{{ $question->created_at }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('questions.edit', ['question' => $question->id]) }}" class="icon-bts">
                                                    <i class="me-3 far fas fa-edit fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('questions.destroy', ['question' => $question->id]) }}" method="post" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-bts"
                                                            onclick="return confirm('Подтвердите удаление')">
                                                        <i class="me-3 far fas fa-trash fa-fw" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                                {{--<a href="24" class="icon-bts">
                                                    <i class="me-3 far fas fa-eye fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <a href="25" class="icon-bts">
                                                    <i class="me-3 far fas fa-trash fa-fw" aria-hidden="true"></i>
                                                </a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Вопросов не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

