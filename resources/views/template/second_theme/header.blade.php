<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {!! \App\Helpers\Helper::systemSet() !!}
    {{--User style--}}
    <link rel="stylesheet" href="{{asset('css/user_style.css')}}">
    <link rel="stylesheet" href="{{assert('css/bootstrap.css')}}">

</head>
<body>

@include('admin_page.head_admin_menu')

@yield('content')

</body>
</html>
