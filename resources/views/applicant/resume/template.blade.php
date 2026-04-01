<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Резюме: {{ $resume->position }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 2cm;
            line-height: 1.6;
            color: #333;
        }
        .header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #27A746;
            padding-bottom: 10px;
        }
        .header-info {
            text-align: left;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #27A746;
        }
        .header p {
            margin: 5px 0;
            color: #555;
        }
        .photo {
            width: 180px;
            height: 180px;
            border: 1px solid #ddd;
            background-color: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .no-photo-text {
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
            color: #27A746;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
        .contact-list {
            list-style: none;
            padding: 0;
        }
        .contact-list li {
            margin-bottom: 5px;
        }
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .skill {
            background: #e9f7ef;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }
        .experience-item, .education-item {
            margin-bottom: 15px;
        }
        .exp-title, .edu-title {
            font-weight: bold;
            color: #2c3e50;
        }
        .exp-subtitle, .edu-subtitle {
            font-style: italic;
            color: #7f8c8d;
            margin: 2px 0;
        }
        .exp-period, .edu-period {
            color: #95a5a6;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="header-info">
        <h1>{{ $resume->getApplicant->name }} {{ $resume->getApplicant->surname }}</h1>
        <p>{{ $resume->position }}</p>
        @if($resume->salary)
            <p><strong>Желаемая зарплата:</strong> {{ number_format($resume->salary, 0, '', ' ') }} ₽</p>
        @endif
    </div>
    <div class="photo">
        @if($resume->getApplicant->photoUrl && !str_starts_with($resume->getApplicant->photoUrl, '/assets/img/no-photo.webp'))
            <img src="{{ public_path($resume->getApplicant->photoUrl) }}" alt="Фото">
        @else
            <div class="no-photo-text">Фото<br>отсутствует</div>
        @endif
    </div>
</div>

<div class="section">
    <h2>Контакты</h2>
    @if($resume->getApplicant->getContact->phone)
        <p><strong>Телефон:</strong> {{ $resume->getApplicant->getContact->phone }}</p>
    @endif
    <p><strong>Email:</strong> {{ $resume->getApplicant->getContact->email }}</p>
</div>
<div class="section">
    <h2>Личная информация</h2>
    <p><strong>Город:</strong> {{ $resume->getApplicant->city_name }}</p>
    <p><strong>Возраст:</strong>
        @if($resume->getApplicant->birth_date)
            @php
                $birthDate = \Carbon\Carbon::parse($resume->getApplicant->birth_date);
                $age = $birthDate->age;
            @endphp
            {{ $age }} лет
        @else
            не указан
        @endif
    </p>
    <p><strong>Образование:</strong> {{ $resume->getApplicant->education }}</p>
    <p><strong>Пол:</strong> {{ $resume->getApplicant->gender }}</p>
    <p><strong>Гражданство:</strong> {{ $resume->getApplicant->citizenship ?? 'не указано' }}</p>
    <p><strong>Водительское удостоверение:</strong> {{ $resume->getApplicant->driving_license ? 'Есть' : 'Нет' }}</p>
    <p><strong>Женат/Замужем:</strong> {{ $resume->getApplicant->married ? 'Да' : 'Нет' }}</p>
    @if($resume->getApplicant->married)
        <p><strong>Дети:</strong> {{ $resume->getApplicant->children ? 'Да' : 'Нет' }}</p>
    @endif
</div>

@if($resume->getApplicant->getExperiences && $resume->getApplicant->getExperiences->isNotEmpty())
    <div class="section">
        <h2>Опыт работы</h2>
        @foreach($resume->getApplicant->getExperiences as $exp)
            <div class="experience-item">
                <div class="exp-title">{{ $exp->position }}</div>
                <div class="exp-subtitle">{{ $exp->organization }}, {{ $exp->city }}</div>
                <div class="exp-period">
                    {{ \Carbon\Carbon::parse($exp->period_start)->format('m.Y') }}
                    –
                    @if($exp->present)
                        Настоящее время
                    @else
                        {{ \Carbon\Carbon::parse($exp->period_end)->format('m.Y') }}
                    @endif
                </div>
                <p>{{ $exp->description ?? '' }}</p>
            </div>
        @endforeach
    </div>
@endif

@if($resume->getApplicant->getEducations && $resume->getApplicant->getEducations->isNotEmpty())
    <div class="section">
        <h2>Образование</h2>
        @foreach($resume->getApplicant->getEducations as $edu)
            <div class="education-item">
                <div class="edu-title">{{ $edu->institution }}</div>
                <div class="edu-subtitle">{{ $edu->faculty }}, {{ $edu->specialization }}</div>
                <div class="edu-period">
                    {{ \Carbon\Carbon::parse($edu->period_start)->format('Y') }}
                    –
                    @if($edu->present)
                        Настоящее время
                    @else
                        {{ \Carbon\Carbon::parse($edu->period_end)->format('Y') }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif



<div class="footer">
    Резюме сгенерировано автоматически на сайте {{ config('app.url') }}<br>
    Дата создания: {{ now()->format('d.m.Y H:i') }}
</div>
</body>
</html>
