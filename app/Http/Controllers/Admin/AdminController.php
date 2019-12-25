<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidationRequest;
use App\Models\Category;
use App\Models\Content;
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
    public function index()
    {
        return redirect()->route('admin_main');
    }

    public function show_main()
    {
        return view('admin_page.admin_main');
    }

    public function displayFormAddContent()
    {
        $categories = Category::all(['id', 'name', 'active']);

        return view('admin_page.content.display_all_categories', compact('categories'));
    }

    public function show_account()
    {
        return view('admin_page.admin_account');
    }

    public function show_setting()
    {
        $all_dir_in_template = array();

        //Просматриваем, какие папки есть в папке "templete"
        $dir = opendir(resource_path('/views/template'));
        while ($file = readdir($dir)) {
            if ($file != "." && $file != "..") {
                //Запихивает в массив $all_dir_in_template найденные папки
                array_push($all_dir_in_template, $file);
            }
        }

        //Если в папке "template" всё таки есть папки
        if (count($all_dir_in_template) > 0) {
            foreach ($all_dir_in_template as $user_template) {
                //Проходит по всем найденным папкам и проверет на наличие неообходимых файлов
                if (file_exists(resource_path('/views/template/' . $user_template . '/description.json')) && file_exists(public_path('/template/' . $user_template . '/screen.jpg')) && View::exists('template.' . $user_template . '.header')) {
                    $json_data = json_decode(file_get_contents(resource_path("/views/template/" . $user_template . "/description.json")), true);

                    //Если в json есть необходимые поля
                    if (array_key_exists('theme', $json_data) && array_key_exists('author', $json_data) && array_key_exists('desc', $json_data)) {
                        //Проевряет на наличие уже созданной строки в таблице по аттрибуту "name_dir"
                        $all_theme = All_themes::where('name_dir', $user_template)->first();
                        if ($all_theme == null) {
                            //Если нет такой темы, то записывается в таблицу
                            $all_theme = new All_themes;
                            $all_theme->name_dir = $user_template;
                            $all_theme->name_theme = $json_data['theme'];
                            $all_theme->name_author = $json_data['author'];
                            $all_theme->description_theme = $json_data['desc'];
                            $all_theme->use_theme = false;

                            $all_theme->save();
                        } else {
                            //Если есть такая тема, то обновляет данные в таблице
                            All_themes::where('id', $all_theme->id)->update([
                                'name_theme' => $json_data['theme'],
                                'name_author' => $json_data['author'],
                                'description_theme' => $json_data['desc']
                            ]);
                        }
                    }
                }
            }
            //Проверят, а были удалены некоторые темы, если да, то удаляет эту тему в таблице
            foreach (All_themes::all() as $value) {
                if (!in_array($value->name_dir, $all_dir_in_template))
                    All_themes::destroy($value->id);
            }

            return view('admin_page.admin_setting', [
                'error' => false,
                'all_themes' => All_themes::all()
            ]);
        }

        //если нет таких файлов
        return view('admin_page.admin_setting', [
            'error' => true,
        ]);
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
        All_themes::where('use_theme', 1)->update(['use_theme' => 0]);

        All_themes::where('id', $request->input('theme'))->update(['use_theme' => 1]);

        return redirect()->back();
    }

    public function displayAllContent($id)
    {
        $aRSelected_category = Category::where('id',$id)->first()->content;

        return view('admin_page.content.list_content', compact('aRSelected_category','id'));
    }

//    public function addContent(Request $request)
//    {
//        //Сохраняет новую категорию
//        $category = new Category;
//        $category->name = $request->input('category_name');
//        $category->save();
//
//        //Получает последний id в таблице "categories"
//        $last_row = Category::orderBy('id', 'desc')->first();
//
//        //Записывает данные в переменную
//        $arResult = "";
//        $arResult .= "<option>" . $last_row->name . "</option>";
//
//        echo json_encode($arResult);
//    }

    public function displayFormContent($id)
    {
        return view('admin_page.content.form_add_content',compact('id'));
    }

    public function addContent(ValidationRequest $request,$id)
    {
        $category=Category::find($id);
        $content=new Content([
            'title'=>$request->input('title'),
            'active'=>1,
            'content'=>$request->input('content')
        ]);
        $category->content()->save($content);

        return redirect()->route('list_content',$id);
    }
}
