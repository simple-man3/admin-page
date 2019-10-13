@extends('layouts.app')

@section('admin_page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-flex flex-row" style="padding: 0;">
                <div class="admin_sidebar_panel">
                    <div class="@if(Route::current()->getName()=='admin_main') click @endif">
                        <a href="{{route('admin_main')}}">
                            <div class="admin_main">
                                Главное
                            </div>
                        </a>
                    </div>
                    <div class="@if(Route::current()->getName()=='admin_content') click @endif">
                        <a href="{{route('admin_content')}}">
                            <div class="admin_content">
                                Контент
                            </div>
                        </a>
                    </div>
                    <div class="@if(Route::current()->getName()=='admin_account') click @endif">
                        <a href="{{route('admin_account')}}">
                            <div class="admin_account">
                                Политка безопасности
                            </div>
                        </a>
                    </div>
                    <div class="@if(Route::current()->getName()=='admin_setting') click @endif">
                        <a href="{{route('admin_setting')}}">
                            <div class="setting">
                                Настройки
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="admin_another">
                    @yield('admin_main')
                    @yield('admin_content')
                    @yield('admin_account')
                    @yield('admin_setting')
                </div>
            </div>
        </div>
    </div>
@endsection
