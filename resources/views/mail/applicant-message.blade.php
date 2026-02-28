<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новое сообщение на сайте</title>
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
        <h1>Здравствуйте {{$data['name']}}!</h1>
        <h3>Вы получили новое сообщение на сайте job-hunter.ru</h3>
        <p>Сообщение от пользователя с email: {{$data['email']}}</p>
    </div>
</div>

</body>
</html>

