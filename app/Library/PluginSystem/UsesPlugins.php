<?php
/**
 * Created by PhpStorm.
 * User: ReeNekt
 * Date: 04.11.2019
 * Time: 13:23
 */

namespace App\Library\PluginSystem;


trait UsesPlugins
{
    /**
     * Список подключенных плагинов
     *
     * @var AbstractPlugin[]
     */
    public static $plugins = [];

    /**
     * Возвращает интерфейс для валидации плагинов при загрузке в менеджер плагинов
     *
     * @return string
     */
    abstract public function GetPluginInterface(): string;

    public static function addPlugin(AbstractPlugin $plugin)
    {
        self::$plugins = array_merge(self::$plugins, [$plugin]);
    }

    public static function getPlugins()
    {
        return self::$plugins;
    }
}
