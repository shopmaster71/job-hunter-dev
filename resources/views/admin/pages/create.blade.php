@extends('admin.layout.app')
@section('title', 'Админпанель - Новая страница')
@section('description', 'Админпанель - Новая страница')
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Новая страница</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Страницы</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Новая страница</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form role="form" action="{{ route('pages.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 md-col-8">
                            <label for="title" class="form-label">Заголовок <sup>*</sup></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                                   placeholder="Название" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                            {{ $errors->get('title')[0] }}
                                        </div>
                                    @endif
                        </div>
                        <div class="form-group mb-3 md-col-8">
                            <label class="form-label" for="content">Контент <sup>*</sup></label>
                            <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                    {{ $errors->get('content')[0] }}
                                </div>
                            @endif
                        </div>

                        <!-- Внешний загрузчик изображений -->
                        <div class="form-group mb-3 col-12">
                            <label class="form-label">Загрузить изображение в редактор</label>
                            <input type="file" id="external-upload" accept="image/*" class="form-control">
                            <div id="image-link-output" style="margin-top:10px; display:none;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- Meta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TinyMCE локально (без CDN) -->
    <script src="{{ asset('assets/admin/js/tinymce/tinymce.min.js') }}"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Инициализация TinyMCE -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Проверка наличия CSRF токена
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('❌ CSRF token not found');
                return;
            }

            // Проверка наличия элемента контента
            const contentElement = document.getElementById('content');
            if (!contentElement) {
                console.error('❌ Элемент #content не найден в DOM');
                return;
            }

            // Проверка загрузки TinyMCE
            if (typeof tinymce === 'undefined') {
                console.error('❌ TinyMCE не загрузился. Проверьте путь к скрипту.');
                return;
            }

            // Инициализация TinyMCE
            tinymce.init({
                selector: '#content',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | removeformat | image | code | help',
                content_style: 'body { font-family: Arial, sans-serif; font-size:14px }',
                language_url: '{{ asset('assets/admin/js/tinymce/langs/ru.js') }}',
                language: 'ru',
                license_key: 'gpl',
                images_upload_handler: window.handleImageUpload, // Ссылка на отдельную функцию
                setup: function (editor) {
                    editor.on('init', function () {
                        console.log('✅ TinyMCE инициализирован');
                        editor.getContainer().style.visibility = 'visible';
                    });
                },
                init_instance_callback: function (editor) {
                    console.log('✅ Редактор видим и готов');
                }
            });
        });
    </script>


    <!-- Внешний загрузчик изображений -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const externalUpload = document.getElementById('external-upload');
            const imageLinkOutput = document.getElementById('image-link-output');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (externalUpload && imageLinkOutput) {
                externalUpload.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('upload', file);
                    formData.append('_token', csrfToken);

                    fetch('{{ route("news.upload-image") }}', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Ошибка сети');
                            return response.json();
                        })
                        .then(data => {
                            if (data.location) {
                                imageLinkOutput.style.display = 'block';
                                imageLinkOutput.innerHTML = `
                                <strong>Ссылка на изображение:</strong>
                                <input type="text" value="${data.location}" readonly
                                       style="width:100%; margin-top:8px; padding:4px; font-size:12px;"
                                       onclick="this.select()" />
                                <button type="button"
                                        onclick="document.execCommand('insertHTML', false, '<img src=\\'${data.location}\\' alt=\\'\\' style=\\'max-width:100%;\\'>');"
                                        style="margin-top:8px; padding:4px 8px;">
                                    Вставить в редактор
                                </button>
                                <button type="button"
                                        onclick="this.parentElement.style.display='none';"
                                        style="margin-left:8px; padding:4px 8px;">
                                    Закрыть
                                </button>
                            `;
                            } else {
                                alert(data.error || 'Не удалось получить ссылку');
                            }
                        })
                        .catch(err => {
                            console.error('Ошибка загрузки:', err);
                            alert('Ошибка при загрузке изображения');
                        });
                });
            }
        });
    </script>
@endpush
