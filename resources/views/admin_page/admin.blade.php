@extends('layouts.app')

@section('title','Главное press-start-cms')

@section('admin_page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-flex flex-row" style="padding: 0;">
                <div class="admin_sidebar_panel">
                    <ul>
                        <li>
                            <a class="link_admin_page link_admin_page_home @if(Route::current()->getName()=='admin_main') selected_home_admin_page selected_admin_point @endif" href="{{route('admin_main')}}">
                                <div class="admin_main">
                                    Главное
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="admin_content link_admin_page link_admin_page_content
                                     @if(Route::current()->getName()=='list_categories' ||
                                        Route::current()->getName()=='list_content'     ||
                                        Route::current()->getName()=='from_add_content')
                                        selected_content_amin_page
                                    @endif">
                                Контент
                            </div>
                            <ul class="spisok_admin_content
                                    @if(Route::current()->getName()=='list_categories' ||
                                        Route::current()->getName()=='list_content'    ||
                                        Route::current()->getName()=='from_add_content'||
                                        Route::current()->getName()=='detail_content')
                                        display_submenu_admin_content
                                    @endif">
                                <li>
                                    <a href="{{route('list_categories')}}" class="
                                        @if(Route::current()->getName()=='list_categories' ||
                                            Route::current()->getName()=='list_content'    ||
                                            Route::current()->getName()=='from_add_content'||
                                            Route::current()->getName()=='detail_content')
                                            font_color
                                        @endif">
                                        Категории
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('admin_account')}}" class="link_admin_page link_admin_page_security
                                    @if(Route::current()->getName()=='admin_account')
                                        click
                                        selected_security_admin_page
                                    @endif">
                                <div class="admin_account">
                                    Политка безопасности
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin_setting')}}" class="link_admin_page link_admin_page_setting
                                @if(Route::current()->getName()=='admin_setting')
                                    click
                                    selected_setting_amin_page
                                @endif">
                                <div class="setting">
                                    Настройки
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                <div class="admin_another">
                    @yield('admin_main')

                    {{--content point admin pge--}}
                    @yield('admin_content')
                    @yield('category_list')
                    @yield('list_contents')
                    @yield('from_add_content')
                    @yield('detail_content')

                    @yield('admin_account')
                    @yield('admin_setting')
                </div>
            </div>
        </div>
    </div>
@endsection
