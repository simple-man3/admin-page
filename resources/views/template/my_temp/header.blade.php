<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {!! Helper::systemSet() !!}
    <link rel="stylesheet" href="{{asset('css/blog_style.css')}}">

</head>
<body>

{{--Подключение админки--}}
@include('admin_page.head_admin_menu')

<header>
    <div class="container">
        {{--Верхняя херня--}}
        <div class="row top_row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <p class="text_title">
                    Large
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <nav class="nav d-flex justify-content-between align-items-center nav_menu">
                    <a href="#">World</a>
                    <a href="#">U.S.</a>
                    <a href="#">Technology</a>
                    <a href="#">Design</a>
                    <a href="#">Culture</a>
                    <a href="#">Business</a>
                    <a href="#">Politics</a>
                    <a href="#">Opinion</a>
                    <a href="#">Science</a>
                    <a href="#">Health</a>
                    <a href="#">Style</a>
                    <a href="#">Travel</a>
                </nav>
            </div>
        </div>
    </div>
</header>

@yield('content')

</body>
</html>
