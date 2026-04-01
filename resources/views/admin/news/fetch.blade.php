@extends('admin.layout.app')
@section('title',  'Админпанель - Импорт новостей')
@section('description', 'Админпанель - Импорт новостей')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Импорт новостей</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Импорт новостей</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h3>Выберите новости для импорта</h3>

        <form action="{{ route('news.import') }}" method="POST">
            @csrf

            @foreach ($items as $item)
                <div class="card mb-3">
                    <div class="row g-0">
                        @if ($item['image'])
                            <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                                <img src="{{ $item['image'] }}" alt="Preview" class="img-fluid rounded" style="max-height: 120px; object-fit: cover;">
                            </div>
                        @endif
                        <div class="{{ $item['image'] ? 'col-md-8' : 'col-12' }}">
                            <div class="card-body">
                                <!-- Заголовок и описание -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected[{{ $loop->index }}][import]" value="1">
                                    <label class="form-check-label">
                                        <strong>{{ $item['title'] }}</strong><br>
                                        <small>Источник: {{ $item['source'] }}</small><br>
                                        <p class="mt-2">{{ $item['description'] }}</p>
                                    </label>
                                </div>

                                <!-- Категория и теги для каждой новости -->
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <select name="selected[{{ $loop->index }}][category_id]" class="form-select form-select-sm">
                                            <option value="">Без категории</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="selected[{{ $loop->index }}][tags][]" class="tags" multiple class="form-select form-select-sm">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Скрытые поля с данными -->
                    <input type="hidden" name="selected[{{ $loop->index }}][title]" value="{{ $item['title'] }}">
                    <input type="hidden" name="selected[{{ $loop->index }}][link]" value="{{ $item['link'] }}">
                    <input type="hidden" name="selected[{{ $loop->index }}][content]" value="{{ $item['content'] }}">
                    <input type="hidden" name="selected[{{ $loop->index }}][source]" value="{{ $item['source'] }}">
                    <input type="hidden" name="selected[{{ $loop->index }}][image]" value="{{ $item['image'] ?? '' }}">
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Импортировать выбранные</button>
            <a href="{{ route('news.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
@push('scripts')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Инициализация Select2 -->
    <script>
        $(document).ready(function () {
            if (typeof $ !== 'undefined' && $('.tags').length) {
                console.log('✅ Инициализация Select2 для #tags');
                $('.tags').select2({
                    placeholder: "Выберите теги",
                    allowClear: true,
                    width: '100%'
                });
            }
        });
    </script>



@endpush

