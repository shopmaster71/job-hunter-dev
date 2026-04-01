@extends('admin.layout.app')
@section('title',  'Админпанель - Новости')
@section('description', 'Админпанель - Новости')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Новости</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новости</li>
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
                                <a href="{{ route('news.create') }}" class="btn btn-success d-none d-md-inline-block text-white">Создать</a>
                                <a href="{{ route('news.fetch') }}" class="btn btn-success d-none d-md-inline-block text-white">Загрузить</a>
                            </div>
                        </div>
                        @if(count($news))
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Заголовок</th>
                                            <th class="border-top-0">Категория</th>
                                            <th class="border-top-0">Просмотров</th>
                                            <th class="border-top-0">Статус</th>
                                            <th class="border-top-0">Дата публикации</th>
                                            <th class="border-top-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($news as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->title }}</td>
                                            <td class="align-middle">{{ $item->getCategory->title }}</td>
                                            <td class="align-middle">{{ $item->views }}</td>
                                            <td class="align-middle">{{ $item->status ? "Не опубликована": "Опубликована" }}</td>
                                            <td class="align-middle">{{ $item->created_at }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('news.edit', ['news' => $item->id]) }}" class="icon-bts">
                                                    <i class="me-3 far fas fa-edit fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('news.destroy', ['news' => $item->id]) }}" method="post" style="display:inline;">
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
                            {{ $news->links('vendor.pagination.bootstrap-4') }}
                        @else
                            <p>Новостей не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
