@extends('admin_page.admin')

@section('list_contents')
    <div class="row">
        <div class="col-12">
            <div class="wrap_list_category">
                <div class="wrap_chain">
                    <a class="a_category" href="{{route('list_categories')}}">
                        Категории
                    </a>
                    <a class="a_content" href="{{route('list_content',$id)}}">
                        Контент
                    </a>
                </div>
                <div class="just_wrap">
                    <div class="wrap_list_title">
                        <p>
                            Контент
                        </p>
                    </div>
                    <div class="wrap_list_btn">
                        <a href="{{route('from_add_content',$id)}}">
                            <input class="btn btn-primary" type="submit" value="Добавить элемент">
                        </a>
                    </div>
                </div>
                <div class="row col_list_category" style="display: flex;flex-wrap: wrap">
                    <div class="col-1">
                        <input type="checkbox" class="main_checkbox_admin_page">
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
                    <div class="col-3">
                        <p>
                            ID
                        </p>
                    </div>
                    <div class="col-12">
                        <form class="form_action" action="{{route('actionListElements',$id)}}" method="post">
                            @csrf
                            @foreach($aRSelected_category as $arItem)
                                <div class="row">
                                    <div class="col-1 list_category_tool">
                                        <input name="checkbox_{{$arItem->id}}" class="row_checkbox" type="checkbox">
                                    </div>
                                    <div class="col-4 list_category_name">
                                        <a href="{{route('detail_content',[$id,$arItem->id])}}">
                                            {{$arItem->title}}
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
                                    <div class="col-3 list_category_id">
                                        <p>
                                            {{$arItem->id}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            @if($aRSelected_category->total() > $aRSelected_category->count())
                                <div class="wrap_pagination">
                                    {{ $aRSelected_category->links()  }}
                                </div>
                            @endif
                            @if($aRSelected_category->count())
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
