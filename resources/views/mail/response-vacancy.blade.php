<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новый отклик на вакансию {{$data['position']}}</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color:
                #f1f1f1;
        }
        .message {
            padding: 20px;
            background-color:
                #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="message">
        <h1>Здравствуйте!</h1>
        <p>Пользователь <b>{{$data['applicant_name']}} {{$data['applicant_surname']}}</b> откликнулся на размещённую Вами вакансию
            {{$data['position']}} на сайте job-hunter.ru</p>
    </div>
</div>

</body>
</html>

