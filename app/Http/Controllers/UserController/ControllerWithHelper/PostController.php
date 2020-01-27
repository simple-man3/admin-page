<?php

namespace App\Http\Controllers\UserController\ControllerWithHelper;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $limit=3;
    protected $another=4;

    public function index()
    {
        $var_a=Helper::getCategory(array(
            'category'=> 4
        ));

//        $kk=Helper::ggg('qwqw');

        dd($var_a);

        //Постер
        $arResult=Helper::getContent(array(
            'category'=>1,
            'content' =>1
        ));

        //Два блока под постером
        //Выбирает данные из первого блока
        $arCategoryFirstBlock=Helper::getCategory(array(
            'category'=>2
        ));

        //Выбирает данные из первого блока
        $arCategorySecondBlock=Helper::getCategory(array(
            'category'=>3
        ));

        //Отображает контент из категории "Цитаты великих людей"
        $arGreatePeople=Helper::getCategory(array(
            'category'=>4
        ));

//        dd($arGreatePeople);

        return view(Helper::usingTheme('index'), compact(
            'arResult',
                  'arCategoryFirstBlock',
                    'arCategorySecondBlock',
                    'arGreatePeople'));
    }
}
