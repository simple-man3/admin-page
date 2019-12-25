@extends('admin_page.admin')

@section('admin_content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="error_list">
                    <p class="title_error">
                        Ошибка:
                    </p>
                    @error('title')
                    <p>
                        {{$message}}
                    </p>
                    @enderror

                    @error('content')
                    <p>
                        {{$message}}
                    </p>
                    @enderror
                </div>
            @endif
        </div>
        <div class="col-md-9">
            <form class="add_content_from" method="post" action="{{route('add_content')}}">
                @csrf
                <p class="add_content_title">
                    Название
                </p>
                <input name="title" type="text"> <br>
                <p>
                    Содержимое
                </p>
                <textarea name="content" id="editor" cols="30" rows="30"></textarea>
                <input class="btn btn-primary" type="submit" value="Сохранить">
            </form>
        </div>
        <div class="col-md-3">
            <div class="wrap_choose_category">
                <p>
                    Категория
                </p>
                <select multiple class="dispaly_all_category">
                    @foreach($categories as $arCategories)
                        <option>{{$arCategories->name}}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary btn_add_category" type="submit" value="Добавить картегорию">
                <div class="wrap_add_category">
                    <p>
                        Название категории
                    </p>
                    <input type="text" class="area_add_category">
                    <input class="btn btn-primary btn_add_category_ajax" type="submit" value="Добавить картегорию">
                </div>
            </div>
        </div>
    </div>
@endsection
