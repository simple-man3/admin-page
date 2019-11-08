<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\SystemSettings;
use Illuminate\Support\Facades\Gate;
use App\Models\All_themes;
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
        $A=array();

        //Просматриваем, какие папки есть в папке "templete"
        $dir = opendir(resource_path('/views/template'));
        while($file = readdir($dir)) {
            if($file!="." && $file!="..")
            {
                //Запихивает в массив $A найденные папки
                array_push($A,$file);
            }
        }

        //Если в папке "template" всё таки есть папки
        if(count($A)>0)
        {
            foreach ($A as $a)
            {
                //Проходит по всем найденным папкам и проверет на наличие неообходимых файлов
                if(file_exists(resource_path('/views/template/'.$a.'/description.json')) && file_exists(resource_path('/views/template/'.$a.'/screen.jpg')) && View::exists('template.'.$a.'.header'))
                {
                    $json_data=json_decode(file_get_contents(resource_path("/views/template/".$a."/description.json")),true);

                    //Если в json есть необходимые поля
                    if(array_key_exists('theme',$json_data) && array_key_exists('author',$json_data) && array_key_exists('desc',$json_data))
                    {
                        //Проевряет на наличие уже созданной строки в таблице по аттрибуту "name_dir"
                        $all_theme = All_themes::where('name_dir', $a)->first();
                        if ($all_theme == null) {
                            //Если нет такой темы, то записывается в таблицу
                            $all_theme = new All_themes;
                            $all_theme->name_dir = $a;
                            $all_theme->name_theme = $json_data['theme'];
                            $all_theme->name_author = $json_data['author'];
                            $all_theme->description_theme = $json_data['desc'];

                            $all_theme->save();
                        }else{
                            //Если есть такая тема, то обновляет данные в таблице
                            All_themes::where('id',$all_theme->id)->update([
                                'name_theme'=>$json_data['theme'],
                                'name_author'=>$json_data['author'],
                                'description_theme'=>$json_data['desc']
                            ]);
                        }
                    }
                }
            }
            //Проверят, а были удалены некоторые темы, если да, то удаляет эту тему в таблице
            foreach (All_themes::all() as $value)
            {
                if(!in_array($value->name_dir,$A))
                    All_themes::destroy($value->id);
            }

            return view('admin_page.admin_setting',[
                'error'=>false,
                'all_themes'=>All_themes::all()
            ]);
        }

        //если нет таких файлов
        return view('admin_page.admin_setting',[
            'error'=>true,

        ]);
//        if(file_exists(resource_path('/views/template/description.json')) && View::exists('template.header') && file_exists(public_path('/img/screen.jpg')))
//        {
//            $json_data=json_decode(file_get_contents(resource_path("/views/template/description.json")),true);
//
//            if(array_key_exists('theme',$json_data) && array_key_exists('author',$json_data) && array_key_exists('desc',$json_data))
//            {
//                return view('admin_page.admin_setting',[
//                    'name_theme'=>$json_data['theme'],
//                    'name_author'=>$json_data['author'],
//                    'description'=>$json_data['desc'],
//                    'error'=>false
//                ])->theme(); // применение темы к данному view. если тема не указана напрямую, то берется значение из БД (если нет и в БД, то берется значение default_theme)
//            }
//        }
//        //если нет таких файлов
//        return view('admin_page.admin_setting',[
//            'error'=>true
//        ]);
    }

    /**
     * Изменение темы
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function change_theme(Request $request)
    {
        // получаем название темы из запроса
        $theme = $request->input('theme');

        /** @var SystemSettings|null $settings */
        $settings = SystemSettings::where(['name' => 'theme'])->first();
        if (!$settings) {
            // если в БД нет настройки тем, то создаем эту настройку
            $settings = new SystemSettings();
            $settings->name = 'theme';
        }

        // изменение значения настройки. значение является массивом, так что менять нужно только так
        $settings_value = $settings->value;
        $settings_value['name'] = $theme;
        $settings->value = $settings_value;

        // сохранение настройки или выброс исключения при ошибке сохранения
        $settings->saveOrFail();

        // возврат к странице настроек
        return redirect()->route('admin_setting');
    }
}
