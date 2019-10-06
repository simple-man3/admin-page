<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:33
 */

namespace App\Library\PluginSystem;


abstract class AbstractPlugin
{
    /**
     * Возвращает класс менеджера, к которому нужно подключить плагин
     *
     * @return string
     */
    abstract public function GetPluginManager(): string;
}