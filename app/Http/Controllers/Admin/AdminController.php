<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Psy\debug;

class AdminController extends Controller
{

    public function show_main()
    {
        if(\Gate::allows('show_admin_panel'))
        {
            dump('da');
        }else
            dump('net');
        foreach (Auth::user()->roles as $all)
        {
            if($all->super_user==1)
                dump('da');
        }

        dump('just');

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
