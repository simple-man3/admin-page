@extends('admin_page.admin')

@section('admin_setting')
    <p>
        Выбор тем.
    </p>
    <div class="alert alert-info">
        Сейчас выбрана тема <code>(DEFAULT THEME dark)</code>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{--отображение тем--}}
                <div class="col-12" style="padding: 0">
                    @if(!$error)
                        <table class="table table-dark">
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
                                    <img class="img-fluid" style="max-width: 300px;" src="{{asset('img/screen.jpg')}}" alt="img">
                                </td>
                                <td>
                                    {{--{{$name_theme}}--}} default_theme
                                </td>
                                <td>
                                    {{--{{$name_author}}--}} reenekt
                                </td>
                                <td>
                                    {{--{{$description}}--}} испытательная тема
                                </td>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle">
                                    <form action="{{ route('admin.settings.change_theme') }}" method="post">
                                        @csrf
                                        {{--todo подставлять значение в value--}}
                                        <input type="hidden" name="theme" value="default_theme_dark">
                                        <button class="btn btn-primary" type="submit">
                                            Выбрать тему
                                        </button>
                                    </form>
                                </th>
                                <td class="">
                                    <img class="img-fluid" style="max-width: 300px;" src="{{asset('img/screen.jpg')}}" alt="img">
                                </td>
                                <td>
                                    {{--{{$name_theme}}--}} default_theme_dark
                                </td>
                                <td>
                                    {{--{{$name_author}}--}} reenekt
                                </td>
                                <td>
                                    {{--{{$description}}--}} испытательная тема - другой цвет таблицы в настройках (админ страница)
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        {{--todo удалить или переделать использую изменения выше (кнопка выбора темы)--}}
                        <div class="row row_name_col w-100">
                            <div class="col-1 admin_name_col_setting_start">

                            </div>
                            <div class="col-2 admin_name_col_setting">
                                <p>
                                    Логотип темы
                                </p>
                            </div>
                            <div class="col-2 admin_name_col_setting">
                                <p>
                                    Название темы
                                </p>
                            </div>
                            <div class="col-2 admin_name_col_setting">
                                <p>
                                    Автор темы
                                </p>
                            </div>
                            <div class="col-5 admin_name_col_setting_end">
                                <p>
                                    Описание
                                </p>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="row w-100 row_admin_theme">
                                <div class="col-1 admin_radio_btn_theme">
                                    <input type="radio">
                                </div>
                                <div class="col-2 admin_screen_theme">
                                    <img style="width: 100%" src="{{asset('img/screen.jpg')}}" alt="img">
                                </div>
                                <div class="col-2 admin_name_theme">
                                    <p>
                                        {{$name_theme}}
                                    </p>
                                </div>
                                <div class="col-2 admin_author_theme">
                                    <p>
                                        {{$name_author}}
                                    </p>
                                </div>
                                <div class="col-5 admin_descriptin_theme">
                                    <p>
                                        {{$description}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12" style="padding: 0">
                                <input class="btn_choose_theme" type="submit" value="выбрать тему">
                            </div>
                        </form>
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
        </div>
    </div>
@endsection
