@extends('admin_page.admin')

@section('title','Контент press-start-cms')

@section('category_list')
    <div class="row">
        <div class="col-12">
            <div class="wrap_list_category">
                <div class="wrap_chain">
                    <a href="{{route('list_categories')}}">
                        Категории
                    </a>
                </div>
                <div class="wrap_title_category">
                    <p>
                        Категории
                    </p>
                    <div>
                        <input class="btn btn-primary btn_category" type="submit" value="Добавить категорию">
                    </div>
                </div>
                @if ($errors->any())
                    <div class="error_list">
                        <p class="title_error">
                            Ошибка:
                        </p>
                        @error('category_name')
                        <p>
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                @endif
                <form method="post" action="{{route('addCategory')}}">
                    @csrf
                    <div class="wrap_ajax_form
                        @if($errors->any())
                            display_form
                        @endif">
                        <input name="category_name" class="ajax_input" type="text" placeholder="название категории">
                        <input class="btn btn-primary btn_ajax_catgory" type="submit" value="Добавить">
                    </div>
                </form>
                <div class="row col_list_category">
                    <div class="col-1">
                        <input type="checkbox" class="main_checkbox_admin_page">
                    </div>
                    <div class="col-1">

                    </div>
                    <div class="col-4">
                        <p>
                            Название
                        </p>
                    </div>
                    <div class="col-4">
                        <p>
                            Активность
                        </p>
                    </div>
                    <div class="col-2">
                        <p>
                            ID
                        </p>
                    </div>

                    <div class="col-12">
                        <form method="post" action="{{route('actionListCategories')}}">
                            @csrf
                            @foreach($aRcategories as $arItem)
                                <div class="row" style="display: flex;flex-wrap: wrap">
                                    <div class="col-1 list_category_tool">
                                        <input name="checkbox_{{$arItem->id}}" class="row_checkbox" type="checkbox">
                                    </div>
                                    <div class="col-1 list_category_change_btn">
                                        <a href="{{route('update_category',$arItem->id)}}">ИЗМЕНИТЬ</a>
                                    </div>
                                    <div class="col-4 list_category_name">
                                        <a href="{{route('list_content',$arItem->id)}}">
                                            {{$arItem->name}}
                                        </a>
                                    </div>
                                    <div class="col-4 list_category_active">
                                        @if($arItem->active)
                                            <p>
                                                Активно
                                            </p>
                                        @else
                                            <p>
                                                Не активно
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-2 list_category_id">
                                        <p>
                                            {{$arItem->id}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            @if($aRcategories->total() > $aRcategories->count())
                                <div class="wrap_pagination">
                                    {{ $aRcategories->links()  }}
                                </div>
                            @endif
                            @if($aRcategories->count())
                                <div class="col-12" style="padding: 0">
                                    <div class="two_tags">
                                        <div class="select_tag">
                                            <select name="option_action" class="select">
                                                <option disabled selected > - ДЕЙСТВИЯ - </option>
                                                <option>Активировать</option>
                                                <option>Деактивировать</option>
                                                <option>Удалить</option>
                                            </select>
                                        </div>
                                        <div class="input_tag">
                                            <input class="btn btn-primary" type="submit" value="ПРИМЕНИТЬ">
                                        </div>
                                    </div>
                                    <div class="disapled_two_tags"></div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
