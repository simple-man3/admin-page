<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Psy\debug;

class AdminController extends Controller
{

    public function show_main()
    {
//        if(Gate::allows('select_role_user'))
//        {
//            dump('вернуло тру');
//        }else
//        {
//            dump('вернуло фолсе');
//        }
//
//
//        dump(Auth::user()->name);

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
