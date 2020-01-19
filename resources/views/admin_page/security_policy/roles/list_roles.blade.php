@extends('admin_page.admin')

@section('list_roles')
    <div class="row">
        <div class="col-12">
            <div class="wrap_list_category">
                <div class="wrap_chain">
                    <a href="{{route('all_roles')}}">
                        Список ролей
                    </a>
                </div>
                <div class="wrap_title_category">
                    <p>
                        Категории
                    </p>
                    <div>
                        <input class="btn btn-primary btn_category" type="submit" value="Добавить роль">
                    </div>
                </div>
                @if ($errors->any())
                    <div class="error_list">
                        <p class="title_error">
                            Ошибка:
                        </p>
                        @error('role_name')
                        <p>
                            {{$message}}
                        </p>
                        @enderror
                        @error('ar')
                        <p>
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                @endif
                <form method="post" action="{{route('add_role')}}">
                    @csrf
                    <div class="wrap_ajax_form
                        @if($errors->any())
                            display_form
                        @endif">
                        <input name="role_name" class="ajax_input" type="text" placeholder="название роли">
                        <input class="btn btn-primary btn_ajax_catgory" type="submit" value="Добавить">
                    </div>
                </form>
                <div class="row col_list_category">
                    <div class="col-1">
                        <input type="checkbox" class="main_checkbox_admin_page">
                    </div>
                    <div class="col-md-6">
                        <p>
                            Название
                        </p>
                    </div>
                    <div class="col-md-5">
                        <p>
                            ID
                        </p>
                    </div>
                    <div class="col-12">
                        <form method="post" action="{{route('action_role')}}">
                            @csrf
                            @foreach($all_roles as $arItem)
                                <div class="row" style="display: flex;flex-wrap: wrap">
                                    <div class="col-1 list_category_tool">
                                        <input name="checkbox_{{$arItem->id}}" class="row_checkbox" type="checkbox">
                                    </div>
                                    <div class="col-md-6 list_category_name">
                                        <a href="{{route('detail_role',$arItem->id)}}">
                                            {{$arItem->name}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 list_category_id">
                                        <p>
                                            {{$arItem->id}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            @if($all_roles->total() > $all_roles->count())
                                <div class="wrap_pagination">
                                    {{ $all_roles->links()  }}
                                </div>
                            @endif
                            @if($all_roles->count())
                                <div class="col-12" style="padding: 0">
                                    <div class="two_tags">
                                        <div class="select_tag">
                                            <select name="option_action" class="select">
                                                <option disabled selected > - ДЕЙСТВИЯ - </option>
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
