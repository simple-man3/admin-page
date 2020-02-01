<?php

namespace App\Http\Controllers\UserController;

use App\Helpers\Helper;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
//        $ar=Helper::getListContent(array(
//                'category'=>34,
//                'paginate'=>2
//        ));

        $ar=Helper::getListCategories(array(
            'paginate'=>100
        ));

        return view(Helper::usingTheme().'header',compact('ar'));
    }
}
