@extends('admin.layout.app')
@section('title',  'Справочник - Группы отраслей')
@section('description', 'Справочник - Группы отраслей')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Группы отраслей</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Группы отраслей</li>
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
                                <a href="{{ route('industry-groups.create') }}" class="btn btn-success d-none d-md-inline-block text-white">Создать</a>
                            </div>
                        </div>
                        @if(count($groupIndustries))
                            <div class="table-responsive mt-5">
                                <table class="table stylish-table no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Группа</th>
                                        <th class="border-top-0">Создана</th>
                                        <th class="border-top-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($groupIndustries as $groupIndustry)
                                        <tr>
                                            <td class="align-middle">{{ $groupIndustry->title }}</td>
                                            <td class="align-middle">{{ $groupIndustry->created_at }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('industry-groups.edit', ['industry_group' => $groupIndustry->id]) }}" class="icon-bts">
                                                    <i class="me-3 far fas fa-edit fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('industry-groups.destroy', ['industry_group' => $groupIndustry->id]) }}" method="post" style="display:inline;">
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
                            <p>Групп отраслей не найдено</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
