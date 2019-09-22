<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:44
 */

namespace App\Plugins\ExampleOne;


use App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginInterface;
use App\Library\PluginManagers\SidebarWidget\SidebarWidgetPluginManager;
use App\Library\PluginSystem\AbstractPlugin;

class ExampleSidebarWidget extends AbstractPlugin implements SidebarWidgetPluginInterface
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
        return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'template.php');
    }
}