@extends('layouts.app')

@section('admin_page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 d-flex flex-row" style="padding: 0;">
                <div class="admin_sidebar_panel">
                    <ul>
                        <li>
                            <a class="link_admin_page @if(Route::current()->getName()=='admin_main') selected_admin_point @endif" href="{{route('admin_main')}}">
                                <div class="admin_main">
                                    Главное
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="admin_content">
                                Контент
                            </div>
                            <ul class="spisok_admin_content
                                    @if(Route::current()->getName()=='list_categories' ||
                                        Route::current()->getName()=='list_content'    ||
                                        Route::current()->getName()=='from_add_content')
                                        display_submenu_admin_content
                                    @endif">
                                <li>
                                    <a href="#">Весь контент</a>
                                </li>
                                <li>
                                    <a href="{{route('list_categories')}}" class="
                                        @if(Route::current()->getName()=='list_categories' ||
                                            Route::current()->getName()=='list_content'    ||
                                            Route::current()->getName()=='from_add_content')
                                            font_color
                                        @endif">
                                        Все категории
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="link_admin_page @if(Route::current()->getName()=='admin_account') click @endif" href="{{route('admin_account')}}">
                                <div class="admin_account">
                                    Политка безопасности
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="link_admin_page @if(Route::current()->getName()=='admin_setting') click @endif" href="{{route('admin_setting')}}">
                                <div class="setting">
                                    Настройки
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-9">
                <div class="admin_another">
                    @yield('admin_main')

                    @yield('admin_content')
                    @yield('category_list')
                    @yield('list_contents')
                    @yield('from_add_content')

                    @yield('admin_account')
                    @yield('admin_setting')
                </div>
            </div>
        </div>
    </div>
@endsection
