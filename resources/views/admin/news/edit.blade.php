@extends('admin.layout.app')
@section('title', 'Админпанель - Изменение новости '.$news->title)
@section('description', 'Админпанель - Изменение новости '.$news->title)
@section('content')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Изменение новости "{{ $news->title }}"</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Главная страница</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Новости</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Изменение новости "{{ $news->title }}"</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form role="form" action="{{ route('news.update', $news) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group mb-3 col-12 mg-col-12">
                                    <label for="title" class="form-label">Заголовок <sup>*</sup></label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Название"
                                           value="{{ old('title', $news->title) }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                            {{ $errors->get('title')[0] }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-3 col-6 mg-col-12">
                                    <label for="category_id" class="form-label">Категория <sup>*</sup></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        @foreach($categories as $k => $v)
                                            <option value="{{ $k }}" {{ old('category_id', $news->category_id) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="invalid-feedback animated fadeInDown" style="display: block;">
                                            {{ $errors->get('category_id')[0] }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-3 col-6 mg-col-12">
                                    <label class="form-label" for="tags">Тэги</label>
                                    <select id="tags" name="tags[]" data-placeholder="Тэги" style="width: 100%;" multiple>
                                        @foreach($tags as $k => $v)
                                            <option value="{{ $k }}" {{ in_array($k, old('tags', $news->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-12">
                                    <label class="form-label" for="subheading">Подзаголовок <sup>*</sup></label>
                                    <textarea class="form-control" id="subheading" name="subheading" rows="3">{{ old('subheading', $news->subheading) }}</textarea>
                                </div>

                                <div class="form-group mb-3 col-12">
                                    <label class="form-label" for="content">Контент <sup>*</sup></label>
                                    <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $news->content) }}</textarea>
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
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Поле загрузки изображения новости -->
                            <div class="form-group mb-3">
                                <label class="form-label" for="image">Изображение новости</label>
                                <div class="upload-area" id="uploadArea" style="border: 2px dashed #ccc; border-radius: 8px; padding: 25px; text-align: center; cursor: pointer; background-color: #f9f9f9;">
                                    <p>Перетащите изображение сюда или кликните для выбора</p>
                                    <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                                    <img id="imagePreview" src="{{ $news->image ? asset($news->image) : '' }}" alt="Превью" style="max-width: 100%; max-height: 300px; margin-top: 10px; display: {{ $news->image ? 'block' : 'none' }}; border-radius: 4px;">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->get('image')[0] }}
                                    </div>
                                @endif
                            </div>
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('❌ CSRF token not found');
                return;
            }

            const contentElement = document.getElementById('content');
            if (!contentElement) {
                console.error('❌ Элемент #content не найден в DOM');
                return;
            }

            if (typeof tinymce === 'undefined') {
                console.error('❌ TinyMCE не загрузился. Проверьте путь к скрипту.');
                return;
            }

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
                images_upload_handler: window.handleImageUpload,
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

    <!-- Обработчик загрузки изображений -->
    <script>
        window.handleImageUpload = function (blobInfo, success, failure) {
            const formData = new FormData();
            formData.append('upload', blobInfo.blob());
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            const xhr = new XMLHttpRequest();

            const hideDialogs = () => {
                ['.tox-dialog', '.tox-dialog-wrap', '.tox-progress-container'].forEach(sel => {
                    const el = document.querySelector(sel);
                    if (el) el.style.display = 'none';
                });
            };

            xhr.open('POST', '{{ route("news.upload-image") }}');

            xhr.onload = function () {
                hideDialogs();

                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.location) {
                            const output = document.getElementById('image-link-output');
                            if (output) {
                                output.style.display = 'block';
                                output.innerHTML = `
                                    <strong>Ссылка на изображение:</strong>
                                    <input type="text" value="${response.location}" readonly
                                           style="width:100%; margin-top:8px; padding:4px; font-size:12px;"
                                           onclick="this.select()" />
                                    <button type="button" onclick="document.execCommand('insertHTML', false, '<img src=\\'${response.location}\\' alt=\\'\\' style=\\'max-width:100%;\\'>');"
                                            style="margin-top:8px; padding:4px 8px;">Вставить</button>
                                    <button type="button" onclick="this.parentElement.style.display='none';"
                                            style="margin-left:8px; padding:4px 8px;">Закрыть</button>
                                `;
                            }
                            success(response.location);
                        } else {
                            failure(response.error || 'Нет URL в ответе');
                        }
                    } catch (e) {
                        failure('Неверный формат ответа');
                    }
                } else {
                    failure('Ошибка сервера: ' + xhr.status);
                }
            };

            xhr.onerror = function () {
                hideDialogs();
                failure('Сетевая ошибка');
            };

            xhr.send(formData);
        };
    </script>

    <!-- Инициализация Select2 -->
    <script>
        $(document).ready(function () {
            const $tagsSelect = $('#tags');

            if ($tagsSelect.length) {
                const selectedIds = @json(old('tags', $news->tags->pluck('id')->toArray()));

                console.log('Ожидаемые ID тегов:', selectedIds);

                if ($tagsSelect.data('select2')) {
                    $tagsSelect.select2('destroy');
                }

                $tagsSelect.select2({
                    placeholder: "Выберите теги",
                    allowClear: true,
                    width: '100%'
                });

                $tagsSelect.val(selectedIds);
                $tagsSelect.trigger('change');

                console.log('Select2 инициализирован. Выбранные теги:', $tagsSelect.val());
            }
        });
    </script>

    <!-- Логика drag-and-drop загрузки изображения -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            if (uploadArea && fileInput && imagePreview) {
                uploadArea.addEventListener('click', () => fileInput.click());

                fileInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });

                ['dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, e => e.preventDefault());
                });

                uploadArea.addEventListener('dragover', () => {
                    uploadArea.style.borderColor = '#007bff';
                    uploadArea.style.backgroundColor = '#f0f8ff';
                });

                uploadArea.addEventListener('dragleave', () => {
                    uploadArea.style.borderColor = '#ccc';
                    uploadArea.style.backgroundColor = '#f9f9f9';
                });

                uploadArea.addEventListener('drop', function (e) {
                    uploadArea.style.borderColor = '#ccc';
                    uploadArea.style.backgroundColor = '#f9f9f9';

                    const files = e.dataTransfer.files;
                    if (files.length) {
                        fileInput.files = files;
                        const reader = new FileReader();
                        reader.onload = e => {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });
            }
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

