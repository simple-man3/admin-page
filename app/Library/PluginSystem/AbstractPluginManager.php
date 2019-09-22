<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:26
 */

namespace App\Library\PluginSystem;


abstract class AbstractPluginManager
{
    /**
     * Список подключенных плагинов
     *
     * @var array
     */
    public static $plugins = [];

    /**
     * Возвращает интерфейс для валидации плагинов при загрузке в менеджер плагинов
     *
     * @return string
     */
    abstract public function GetPluginInterface(): string;
}