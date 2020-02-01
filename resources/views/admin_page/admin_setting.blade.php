@extends('admin_page.admin')

@section('title','Настройки press-start-cms')

@section('admin_setting')
    <p>
        Выбор тем
    </p>
    <div class="container-fluid">
        <div class="row">
            {{--отображение тем--}}
            <div class="col-12 bg_content">
                @if(!$error)
                    {{--Названия колонок--}}
                    <div class="row name_cols">
                            <div class="col-2">
                            </div>
                            <div class="col-2">
                                Логотип темы
                            </div>
                            <div class="col-2">
                                Название темы
                            </div>
                            <div class="col-2">
                                Автор темы
                            </div>
                            <div class="col-4">
                                Описание
                            </div>
                        </div>

                    {{--Содержимое--}}
                    @foreach($all_themes as $theme)
                    <div class="row content_table">
                            <div class="col-2 btn_theme">
                                <form action="{{ route('admin.settings.change_theme') }}" method="post">
                                    @csrf
                                    {{--todo подставлять значение в value--}}
                                    {{--DONE--}}
                                    <input type="hidden" name="theme" value="{{$theme->id}}">
                                    <button class="btn btn-primary" type="submit" @if($theme->use_theme==1) disabled @endif>
                                        Выбрать тему
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 logo_theme">
                                <img class="img-fluid" src="{{asset('template/'.$theme->name_dir.'/public/screen.jpg')}}" alt="img">
                            </div>
                            <div class="col-2 name_theme">
                                {{$theme->name_theme}}
                            </div>
                            <div class="col-2 name_author">
                                {{$theme->name_author}}
                            </div>
                            <div class="col-4 description_theme">
                                    {{$theme->description_theme}}
                            </div>
                         </div>
                    @endforeach
                @else
                    <div class="row row_admin_theme" style="border-bottom: none">
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
