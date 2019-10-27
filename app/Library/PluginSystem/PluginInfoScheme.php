<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 25.09.2019
 * Time: 12:14
 */

namespace App\Library\PluginSystem;

/**
 * Class PluginInfoScheme
 * Схема плагина
 *
 * @package App\Library\PluginSystem
 * @author Andrew Sementsov <thesunlightday@gmail.com>
 *
 * @property string $version Версия плагина (пакета)
 * @property array $components Компоненты пакета
 */
class PluginInfoScheme
{
    public $scheme;
    public $package;
    public $vendor;
    public $resources = [
        'views' => [],
        'migrations' => [],
    ];

    public function __construct($path = null)
    {
        if ($path) {
            $this->load($path);
        }
    }

    /**
     * Загружает схему из файла
     *
     * @param string $path Путь к файлу схемы
     */
    public function load(string $path)
    {
        $content = file_get_contents($path);
        $this->scheme = json_decode($content);
        $this->package = basename(dirname($path));
        $this->vendor = basename(dirname($path, 2));
        if (property_exists($this->scheme, 'resources')) {
            if (property_exists($this->scheme->resources, 'views')) {
                $this->resources['views'] = $this->scheme->resources->views;
            }
            if (property_exists($this->scheme->resources, 'migrations')) {
                $this->resources['migrations'] = $this->scheme->resources->migrations;
            }
        }
    }

    /**
     * Проверка правилньости схемы
     *
     * @return bool
     */
    public function validate()
    {
        if ($this->scheme == null) {
            return false;
        }
        $object_vars = array_keys(get_object_vars($this->scheme));
        if (!in_array('version', $object_vars) || !in_array('components', $object_vars)) {
            return false;
        }
        if (!preg_match('/^(\d+\.\d+\.\d+)$/', $this->scheme->version)) {
            return false;
        }
        if (!is_array($this->scheme->components)) {
            return false;
        }

        return true;
    }

    /**
     * Получение свойств схемы
     *
     * @param string $name Название свойства схемы
     * @return mixed
     */
    public function __get($name)
    {
        return $this->scheme->$name;
    }
}
