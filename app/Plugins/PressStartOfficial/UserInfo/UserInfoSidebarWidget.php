<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:44
 */

namespace App\Plugins\PressStartOfficial\UserInfo;


use App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginInterface;
use App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager;
use App\Library\PluginSystem\AbstractPlugin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserInfoSidebarWidget extends AbstractPlugin implements SidebarWidgetPluginInterface
{

    /**
     * Возвращает класс менеджера, к которому нужно подключить плагин
     *
     * @return string
     */
    public function GetPluginManager(): string
    {
        return SidebarWidgetPluginManager::class;
    }

    public function GetRenderedWidget()
    {
        return view('UserInfo::sb_widget', [
            'user' => Auth::user(),
            'isUserAdmin' => Gate::check('select_role_user'),
        ]);
    }
}
