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
