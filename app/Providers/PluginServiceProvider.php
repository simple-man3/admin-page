<?php

namespace App\Providers;

use App\Library\PluginSystem\AbstractPlugin;
use App\Library\PluginSystem\AbstractPluginManager;
use App\Library\PluginSystem\PluginInfoScheme;
use App\Library\PluginSystem\PluginSystemManager;
use App\Library\ReflectionHelper\ReflectionHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    protected $pluginsDir = 'Plugins';
    protected $infoFileName = 'start.plugin.json';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $plugins_path = app_path('Plugins');
//        $plugin_scheme_files = $this->getPluginInfoPaths($plugins_path); // Получение схем - файлов с информацией о плагинах (пакетах)
//        foreach ($plugin_scheme_files as $plugin_scheme_file) {
//            $invalid = false;
//            $scheme = new PluginInfoScheme();
//            $scheme->load($plugin_scheme_file); // Загрузка схем
//            if ($scheme->validate()) {
//                $package_path = dirname($plugin_scheme_file); // Путь к пакету (плагину)
//                $component_paths = $scheme->components; // Список компонентов пакета
//                $reflectionHelper = new ReflectionHelper();
//
//                $this->loadPluginResources($scheme, $package_path);
//
//                foreach ($component_paths as $component_path) {
//                    $component_full_path = $package_path . '/' . $component_path; // Полный путь к компоненту
//                    if (file_exists($component_full_path)) {
//                        try {
//                            $reflectionClass = new \ReflectionClass($reflectionHelper->getClassFullNameFromFile($component_full_path));
//                        } catch (\ReflectionException $e) {
//                            $invalid = true; // Выброс исключения рефлексии
//                            continue;
//                        }
//
//                        // является ли класс компонентом (плагином) // TODO update vars' names
//                        if ($reflectionClass->getParentClass()->getName() == AbstractPlugin::class) {
//                            /** @var AbstractPlugin $plugin Компонент */
//                            $plugin = $reflectionHelper->getClassObjectFromFile($component_full_path);
//                            /** @var AbstractPluginManager $plugin_manager Класс Менеджер компонента */
//                            $pm_class = $plugin->GetPluginManager();
//                            $plugin_manager = new $pm_class;
//
//                            // Проверка компонента на соответствие заданному интерфейсу
//                            $plugin_interface = $plugin_manager->GetPluginInterface();
//                            if (in_array($plugin_interface, $reflectionClass->getInterfaceNames())) {
//                                $plugin_manager::$plugins = array_merge($plugin_manager::$plugins, [$plugin]);
//                            } else {
//                                $invalid = true; // компонент не соответствует заданному интерфейсу
//                            }
//                        }
//                    } else {
//                        $invalid = true; // файл компонента не существует
//                    }
//                }
//            } else {
//                $invalid = true; // неправильная схема
//            }
//
//            // Регистрация плагина в главном менеджере системы плагинов
//            PluginSystemManager::AddPlugin($scheme, $invalid);
//        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $plugins_path = app_path('Plugins');
        $plugin_scheme_files = $this->getPluginInfoPaths($plugins_path); // Получение схем - файлов с информацией о плагинах (пакетах)
        foreach ($plugin_scheme_files as $plugin_scheme_file) {
            $invalid = false;
            $scheme = new PluginInfoScheme();
            $scheme->load($plugin_scheme_file); // Загрузка схем
            if ($scheme->validate()) {
                $package_path = dirname($plugin_scheme_file); // Путь к пакету (плагину)
                $component_paths = $scheme->components; // Список компонентов пакета
                $reflectionHelper = new ReflectionHelper();

                $this->loadPluginResources($scheme, $package_path);

                foreach ($component_paths as $component_path) {
                    $component_full_path = $package_path . '/' . $component_path; // Полный путь к компоненту
                    if (file_exists($component_full_path)) {
                        try {
                            $reflectionClass = new \ReflectionClass($reflectionHelper->getClassFullNameFromFile($component_full_path));
                        } catch (\ReflectionException $e) {
                            $invalid = true; // Выброс исключения рефлексии
                            continue;
                        }

                        // является ли класс компонентом (плагином) // TODO update vars' names
                        if ($reflectionClass->getParentClass()->getName() == AbstractPlugin::class) {
                            /** @var AbstractPlugin $plugin Компонент */
                            $plugin = $reflectionHelper->getClassObjectFromFile($component_full_path);
                            /** @var AbstractPluginManager $plugin_manager Класс Менеджер компонента */
                            $pm_class = $plugin->GetPluginManager();
                            $plugin_manager = new $pm_class;

                            // Проверка компонента на соответствие заданному интерфейсу
                            $plugin_interface = $plugin_manager->GetPluginInterface();
                            if (in_array($plugin_interface, $reflectionClass->getInterfaceNames())) {
                                $plugin_manager::$plugins = array_merge($plugin_manager::$plugins, [$plugin]);
                            } else {
                                $invalid = true; // компонент не соответствует заданному интерфейсу
                            }
                        }
                    } else {
                        $invalid = true; // файл компонента не существует
                    }
                }
            } else {
                $invalid = true; // неправильная схема
            }

            // Регистрация плагина в главном менеджере системы плагинов
            PluginSystemManager::AddPlugin($scheme, $invalid);
        }
    }

    /**
     * Получение всех путей схем (файлов с данными о плагине).
     * Поиск происходить в папках пакетов (плагинов).
     * Структура плагина такова: папка_плагинов/папка_вендора/папка_пакета/файл_схемы.
     * Название файла схемы прописано в коде прогарммы: start.plugin.json
     *
     * @param string $plugins_path Путь к папке плагинов
     * @return array|false
     */
    public function getPluginInfoPaths($plugins_path)
    {
        return glob($plugins_path . '/*/*/' . $this->infoFileName);
    }

    protected function loadPluginResources(PluginInfoScheme $scheme, $package_path)
    {
        if (!empty($scheme->resources['migrations'])) {
            foreach ($scheme->resources['migrations'] as $migration_path) {
                $this->loadMigrationsFrom($package_path . $migration_path);
            }
        }
        if (!empty($scheme->resources['views'])) {
            foreach ($scheme->resources['views'] as $view_path) {
                $this->loadViewsFrom($package_path . $view_path, basename($package_path));
            }
        }
    }
}
