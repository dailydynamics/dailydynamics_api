<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Dynamics</title>
    <style>
        body {
            background-color: black;
        }

        a {
            margin: 1rem;
            background-color: antiquewhite;
            text-decoration: none;
            color: red;
            padding: 2rem;
            border-radius: 1rem;
        }

        div {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div>
        <a href="{{ route('auth.login') }}">Go to Login</a>
    </div>
</body>

</html>
