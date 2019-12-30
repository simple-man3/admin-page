<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Plugins external assets -->
    {!! (new \App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager)->renderInsideHead() !!}

    <!-- System script -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="{{asset('js/systems_script.js')}}"></script>

</head>

<body>
    {{--отображение меню для перехода в админку--}}
    @include('admin_page.head_admin_menu')

    <!--Админка-->
    @yield('admin_page')

    @yield('content')

    <!-- Plugins external assets -->
    {!! (new \App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager)->renderInEdnOfBody() !!}
</body>

</html>
