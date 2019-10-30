<?php

namespace App\Http\Controllers\Admin;

use Config;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
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
        try
        {
            $error=0;
            $json_data="";

            if(file_exists(resource_path('/views/template/description.json')) && View::exists('template.header') && file_exists(public_path('/img/screen.jpg')))
            {
                $error=0;
                $json_data=json_decode(file_get_contents(resource_path("/views/template/description.json")),true);

                return view('admin_page.admin_setting',[
                    'name_theme'=>$json_data['theme'],
                    'name_author'=>$json_data['author'],
                    'description'=>$json_data['desc'],
                    'error'=>$error
                ]);
            }else{
                //если нет таких файлов
                $error=1;
                return view('admin_page.admin_setting',[
                    'error'=>$error
                ]);
            }

        }catch (\Exception  $e)
        {
            //если есть ошибка в коде json
            $error=1;
            return view('admin_page.admin_setting',[
                'error'=>$error
            ]);
        }
    }
}
