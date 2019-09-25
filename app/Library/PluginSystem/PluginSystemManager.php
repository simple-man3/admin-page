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
     * @param PluginInfoScheme $scheme
     * @param bool $invalid
     */
    public static function AddPlugin(PluginInfoScheme $scheme, $invalid = false)
    {
        $record = [
            'scheme' => $scheme,
            'invalid' => $invalid,
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
     * Возвращает список плагинов от определенного вендора (поставщика)
     *
     * @param string $vendor
     * @return array
     */
    public static function GetPluginsByVendor(string $vendor)
    {
        $list = [];
        foreach (static::$plugins as $plugin) {
            /** @var PluginInfoScheme $scheme */
            $scheme = $plugin['scheme'];
            if ($scheme->vendor == $vendor) {
                $list[] = $plugin;
            }
        }
        return $list;
    }

    /**
     * Возвращает плагин по названию пакета
     *
     * @param string $package
     * @return array
     */
    public static function GetPluginByPackage(string $package)
    {
        foreach (static::$plugins as $plugin) {
            /** @var PluginInfoScheme $scheme */
            $scheme = $plugin['scheme'];
            if ($scheme->package == $package) {
                return $plugin;
            }
        }
        return null;
    }
}
