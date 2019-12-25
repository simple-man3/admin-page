@extends('admin_page.admin')

@section('category_list')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="wrap_list_category">
                    <p>
                        Категории
                    </p>
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
                        @foreach($categories as $arItem)
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
