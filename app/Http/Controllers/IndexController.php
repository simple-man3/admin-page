<?php

namespace App\Http\Controllers;

use App\Models\All_themes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    /**
     * Show the application main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_theme=All_themes::where('use_theme',true)->first();
//        dd($count_theme);
        if(!$count_theme==null)
            return view('null_template.null_template');
        else
            return redirect()->route('homeUser');
    }
}
