<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:37
 */

namespace App\Library\PluginManagers\SidebarWidget;


use App\Library\PluginSystem\AbstractPluginManager;

class SidebarWidgetPluginManager extends AbstractPluginManager
{

    /**
     * Возвращает интерфейс для валидации плагинов при загрузке в менеджер плагинов
     *
     * @return string
     */
    public function GetPluginInterface(): string
    {
        return SidebarWidgetPluginInterface::class;
    }

    public function render()
    {
        $renderedHtml = '';
        /** @var SidebarWidgetPluginInterface $plugin */
        foreach (static::$plugins as $plugin) {
            $renderedHtml .= $plugin->GetRenderedWidget();
        }
        return $renderedHtml;
    }
}
