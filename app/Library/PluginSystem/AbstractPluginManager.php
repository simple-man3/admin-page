<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:26
 */

namespace App\Library\PluginSystem;

/**
 * Class AbstractPluginManager
 * @package App\Library\PluginSystem
 */
abstract class AbstractPluginManager
{
    /**
     * Возвращает интерфейс для валидации плагинов при загрузке в менеджер плагинов
     *
     * @return string
     */
    abstract public function GetPluginInterface(): string;

    abstract public static function addPlugin(AbstractPlugin $plugin);

    abstract public static function getPlugins();
}
