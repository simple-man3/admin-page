@extends('admin_page.admin')

@section('list_contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrap_list_category">
                    <div class="just_wrap">
                        <div class="wrap_list_title">
                            <p>
                                Категории
                            </p>
                        </div>
                        <div class="wrap_list_btn">
                            <a href="{{route('from_add_content',$id)}}">
                                <input class="btn btn-primary" type="submit" value="Добавить элемент">
                            </a>
                        </div>
                    </div>
                    <div class="row col_list_category" style="display: flex;flex-wrap: wrap">
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
                        <div class="col-4">
                            <p>
                                ID
                            </p>
                        </div>
                        @foreach($aRSelected_category as $arItem)
                            <div class="col-4 list_category_name">
                                <a href="">
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
                            <div class="col-4 list_category_id">
                                <p>
                                    {{$arItem->id}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
