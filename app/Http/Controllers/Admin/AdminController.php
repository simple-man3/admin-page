<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Psy\debug;

class AdminController extends Controller
{

    public function show_main()
    {
        if(Gate::denies('show_admin_panel'))
        {
            dump('da');
        }else
            dump('net');


        dump(Auth::user()->name);

        return view('admin_page.admin_main');
    }

    public function show_content()
    {
        return view('admin_page.admin_content');
    }

    public function show_account()
    {
        return view('admin_page.admin_account');
    }

    public function show_setting()
    {
        return view('admin_page.admin_setting');
    }
}
