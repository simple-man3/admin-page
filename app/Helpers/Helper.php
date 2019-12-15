<?php

namespace App\Helpers;

use App\Models\All_themes;

class Helper
{
    public static function usingtheme()
    {
        $using_theme=All_themes::where('use_theme',1)->first();
        return 'template.'.$using_theme->name_dir.'.';
    }
}
