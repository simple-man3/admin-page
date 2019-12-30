<?php

namespace App\Helpers;

use App\Models\All_themes;
use App\Models\Category;
use App\Models\Content;

class Helper
{
    /**
     * Class Helper
     * @package App\Helpers
     *
     * Данный хелпер ищет в таблице "All_themes" аттрибут "use_theme",
     * который имеет значение true
     */

    public static function usingTheme()
    {
        $using_theme=All_themes::where('use_theme',1)->first();
        return 'template.'.$using_theme->name_dir.'.';
    }

    /**
     * Возвращает список контента, в зависимости от того, какие параметры юзер передал ('category') и ('paginate')
     * 'category' - передается id категории
     * 'paginate' - передается пагинация, т.е. сколько отображать выводимых элементов

     * Пример:

     * Helper::getListContent(array(
     *      'category'=>34,
     *       'paginate'=>5
     *  ));

     */
    public static function getListContent($arStr)
    {
        //Если юзер указал 'paginate', то выполняется данное условие
        if(array_key_exists('paginate',$arStr))
        {
            $aRSelected_category = Category::where('id',$arStr['category'])->
                                                        where('active',1)->
                                                        first()->
                                                        content()->
                                                        paginate($arStr['paginate']);
        }
        else
            $aRSelected_category = Category::find($arStr['category'])->content->where('active',1);

        return $aRSelected_category;
    }

    /**
     * Возвращает список категорий, зависимости, какаие параметры юзер передал ('paginate')
     * 'paginate' - передается пагинация, т.е. сколько отображать выводимых элементов
     *
     * Пример:
     *
     * Helper::getListCategories(array(
     *         'paginate'=>5
     * ));
     */

    public static function getListCategories($arStr)
    {
        //Если юзер указал 'paginate', то выполняется данное условие
        if(array_key_exists('paginate',$arStr))
        {
            $aRSelected_category=Category::where('active',1)->paginate($arStr['paginate']);
        }
        else
            $aRSelected_category=Category::where('active',1)->get();

        return $aRSelected_category;
    }
}
