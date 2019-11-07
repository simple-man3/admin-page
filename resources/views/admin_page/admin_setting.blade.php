@extends('admin_page.admin')

@section('admin_setting')
    <p>
        Выбор тем
    </p>
    <div class="container-fluid">
        <div class="row">
            {{--отображение тем--}}
                <div class="col-12" style="padding: 0">
                    @if(!$error)
                        <table class="table bg-white">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Логотип темы</th>
                                    <th scope="col">Название темы</th>
                                    <th scope="col">Автор темы</th>
                                    <th scope="col">Описание</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{--todo добавить в контроллере список тем и выводить их тут через @foreach--}}
                                {{--DONE--}}
                                @foreach($all_themes as $all)
                                    <tr>
                                        <th style="vertical-align: middle">
                                            <form action="{{ route('admin.settings.change_theme') }}" method="post">
                                                @csrf
                                                {{--todo подставлять значение в value--}}
                                                <input type="hidden" name="theme" value="default_theme">
                                                <button class="btn btn-primary" type="submit">
                                                    Выбрать тему
                                                </button>
                                            </form>
                                        </th>
                                        <td class="">
                                            <img class="img-fluid" style="max-width: 300px;" src="{{asset('template/'.$all->name_dir.'/screen.jpg')}}" alt="img">
                                        </td>
                                        <td>
                                            {{$all->all_themes}}
                                        </td>
                                        <td>
                                            {{$all->name_author}}
                                        </td>
                                        <td>
                                            {{$all->description_theme}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="row w-100 row_admin_theme" style="border-bottom: none">
                            <div class="col-12 undefind_theme">
                                <p>
                                    Шаблон темы не обнаружен
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
{{--                <div class="col-12" style="padding: 0">--}}
{{--                    @if(!$error)--}}
{{--                        <table class="table bg-white">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col"></th>--}}
{{--                                    <th scope="col">Логотип темы</th>--}}
{{--                                    <th scope="col">Название темы</th>--}}
{{--                                    <th scope="col">Автор темы</th>--}}
{{--                                    <th scope="col">Описание</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}

{{--                                todo добавить в контроллере список тем и выводить их тут через @foreach--}}
{{--                                <tr>--}}
{{--                                    <th style="vertical-align: middle">--}}
{{--                                        <form action="{{ route('admin.settings.change_theme') }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            --}}{{--todo подставлять значение в value--}}
{{--                                            <input type="hidden" name="theme" value="default_theme">--}}
{{--                                            <button class="btn btn-primary" type="submit">--}}
{{--                                                Выбрать тему--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </th>--}}
{{--                                    <td class="">--}}
{{--                                        <img class="img-fluid" style="max-width: 300px;" src="{{asset('img/screen.jpg')}}" alt="img">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$name_theme}}--}}{{-- default_theme--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$name_author}}--}}{{-- reenekt--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$description}}--}}{{-- испытательная тема--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <th style="vertical-align: middle">--}}
{{--                                        <form action="{{ route('admin.settings.change_theme') }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            --}}{{--todo подставлять значение в value--}}
{{--                                            <input type="hidden" name="theme" value="default_theme_dark">--}}
{{--                                            <button class="btn btn-primary" type="submit">--}}
{{--                                                Выбрать тему--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </th>--}}
{{--                                    <td class="">--}}
{{--                                        <img class="img-fluid" style="max-width: 300px;" src="{{asset('img/screen.jpg')}}" alt="img">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$name_theme}}--}}{{-- default_theme_dark--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$name_author}}--}}{{-- reenekt--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        --}}{{--{{$description}}--}}{{-- испытательная тема - другой цвет таблицы в настройках (админ страница)--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    @else--}}
{{--                        <div class="row w-100 row_admin_theme" style="border-bottom: none">--}}
{{--                            <div class="col-12 undefind_theme">--}}
{{--                                <p>--}}
{{--                                    Шаблон темы не обнаружен--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
        </div>
    </div>
@endsection
