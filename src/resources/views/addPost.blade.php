<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>добавление поста</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 200px;
            margin: 30px;
        }

        #submit {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1 style="margin-left: 30px;">Добавление поста</h1>
<form action="{{route('post_add')}}" method="post">
    <label for="title">введите заголовок</label>
    <input type="text" name="title" id="title">

    <label for="text">введите текст</label>
    <textarea name="text" id="text" cols="30" rows="10"></textarea>

    <label for="user_id"></label>
    <select name="user_id" id="user_id" style="margin-top: 20px;">
    @foreach($users as $user)
            <option value="{{$user->id}}">User: {{$user->login}} ( ID : {{$user->id}} )</option>
    @endforeach
    </select>

    <input type="submit" value="добавить пост" id="submit">
</form>
<a href="{{route('main')}}" style="margin-left: 30px; font-size: 28px; font-weight: 700;">Добавить user</a>
</body>
</html>
