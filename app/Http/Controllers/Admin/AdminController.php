<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use View;
use function Psy\debug;

class AdminController extends Controller
{
    public function show_main()
    {
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
        if(file_exists(resource_path('/views/template/description.json')) && View::exists('template.header') && file_exists(public_path('/img/screen.jpg')))
        {
            $json_data=json_decode(file_get_contents(resource_path("/views/template/description.json")),true);

            if(array_key_exists('theme',$json_data) && array_key_exists('author',$json_data) && array_key_exists('desc',$json_data))
            {
                return view('admin_page.admin_setting',[
                    'name_theme'=>$json_data['theme'],
                    'name_author'=>$json_data['author'],
                    'description'=>$json_data['desc'],
                    'error'=>false
                ]);
            }
        }
        //если нет таких файлов
        return view('admin_page.admin_setting',[
            'error'=>true
        ]);
    }
}
