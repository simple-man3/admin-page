@if(Auth::check())
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        @if(Gate::allows('select_role_user'))
            <div class="row">
                <div class="col-10 d-flex justify-content-center my-auto admin_header">
                    <a href="{{route('admin_main')}}">Админ страница</a>
                </div>
                <div class="col-2 my-auto site_header">
                    <a href="/">Сайт</a>
                </div>
            </div>
        @endif
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li>
                    <p>
                        {{Auth::user()->login}}
                    </p>
                </li>
                <li class="nav-item dropdown">
{{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                {{ __('Выйти') }}--}}
{{--                            </a>--}}

{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    <a class="logout_a" href="{{route('custom_logout')}}">Выйти</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif
