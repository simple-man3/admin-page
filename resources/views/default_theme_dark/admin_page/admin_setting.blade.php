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
