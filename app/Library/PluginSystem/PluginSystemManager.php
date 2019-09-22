<?php
/**
 * Created by PhpStorm.
 * User: ReeNekt
 * Date: 22.09.2019
 * Time: 15:28
 */

namespace App\Library\PluginSystem;


class PluginSystemManager
{
    /** @var array $plugins Список плагинов, которые установлены в систему */
    protected static $plugins;

    /**
     * Добавляет плагин в список всех плагинов
     *
     * @param AbstractPlugin $plugin
     * @param bool $invalid
     * @throws \ReflectionException
     */
    public static function AddPlugin(AbstractPlugin $plugin, $invalid = false)
    {
        $plugin_class = (new \ReflectionClass($plugin))->getName();
        $short_name = (new \ReflectionClass($plugin))->getShortName();
        $plugin_manager_class = $plugin->GetPluginManager();

        $record = [
            'plugin' => $plugin_class,         // класс плагина
            'short_name' => $short_name,       // класс плагина без пространства имен
            'type' => $plugin_manager_class,   // тип - менеджер плагина
            'invalid' => $invalid,             // плагин не в работоспособном состоянии, но его файлы находятся в системе
        ];

        static::$plugins[] = $record;
    }

    /**
     * Возвращает список плагинов, установленных в систему
     *
     * @return array
     */
    public static function GetPlugins()
    {
        return static::$plugins;
    }

    /**
     * Возвращает плагин по названию класса
     *
     * @return array
     */
    public static function GetPluginByClassName($class_name)
    {
        foreach (static::$plugins as $plugin) {
            if ($plugin['plugin'] == $class_name) {
                return $plugin;
            }
        }
        return null;
    }

    /**
     * Возвращает плагин по короткому класса (без простарнства имен)
     *
     * @return array
     */
    public static function GetPluginByShortName($short_name)
    {
        foreach (static::$plugins as $plugin) {
            if ($plugin['short_name'] == $short_name) {
                return $plugin;
            }
        }
        return null;
    }
}
