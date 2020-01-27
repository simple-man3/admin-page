@extends('system.admin_page.admin')

@section('detail_role')
    <div class="row">
        <div class="col-12">
            <div class="bg_detail">
                <div class="wrap_chain">
                    <a class="a_content detail_content" href="{{route('all_roles')}}">
                        Список ролей
                    </a>
                    <a class="a_detail" href="javascript:void(0)">
                        {{$role->name}}
                    </a>
                </div>
                <div class="wrap_title_detail">
                    <p>
                        Редактирование: {{$role->name}}
                    </p>
                </div>
                @if ($errors->any())
                    <div class="error_list">
                        <p class="title_error">
                            Ошибка:
                        </p>

                        @error('name_role')
                        <p>
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                @endif
                <form class="add_content_from" method="post" action="{{route('update_role',$role->id)}}">
                    @csrf
                    <div class="detail_date_of_creation">
                        <p>
                            Создано: {{ date('d.m.Y', strtotime($role->created_at))}}
                        </p>
                    </div>
                    <div>
                        <p class="add_content_title">
                            Название
                        </p>
                        <input name="name_role" type="text" value="{{old('name_role',$role->name)}}">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection
