<?php

namespace App\Http\Controllers\UserController\ControllerWithHelper;

use App\Helpers\Helper;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $arResult=Helper::getContent(array(
            'category'=>39,
            'content' =>30
        ));

        return view(Helper::usingTheme('index'),compact('arResult'));
    }
}
