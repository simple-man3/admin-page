<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel')) | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Plugins external assets -->
    {!! (new \App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager)->renderInsideHead() !!}
</head>

<body>
    <div id="app">
        {{--отображение меню для перехода в админку--}}
        @include('admin_page.head_admin_menu')
        <!--Админка-->
        <div class="admin">
            @yield('admin_page')
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Plugins external assets -->
    {!! (new \App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager)->renderInEdnOfBody() !!}
</body>

</html>
