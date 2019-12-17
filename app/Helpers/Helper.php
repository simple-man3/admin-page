<?php

/**
 * Class Helper
 * @package App\Helpers
 *
 * Данный хелпер ищет в таблице "All_themes" аттрибут "use_theme",
 * который имеет значение true
 */

namespace App\Helpers;

use App\Models\All_themes;

class Helper
{
    public static function usingTheme()
    {
        $using_theme=All_themes::where('use_theme',1)->first();
        return 'template.'.$using_theme->name_dir.'.';
    }
}
