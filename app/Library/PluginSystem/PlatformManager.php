<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 29.09.2019
 * Time: 8:54
 */

namespace App\Library\PluginSystem;

use Illuminate\Support\Facades\Log;

/**
 * Class PlatformManager
 * Класс для взаимодействия с платформой
 *
 * @package App\Library\PluginSystem
 * @author Andrew Sementsov <thesunlightday@gmail.com>
 */
class PlatformManager
{
    /**
     * Скачивает файл по ссылке и сохраняет его в указанный файл.
     * Если скачан архив - он не будет распакован!
     *
     * @param string $url Ссылка на файл на сайте платформы
     * @param string $save_path Путь к сохраняемому файлу
     * @example downloadPluginFromUrl('http://platform.site/storage/plugins/Official/SimplePlugin.zip', storage_path('Plugins/Official/SimplePlugin.zip))
     * @return bool
     */
    protected static function downloadPluginFromUrl(string $url, string $save_path)
    {
        return file_put_contents($save_path, fopen($url, 'r')) !== false;
    }

    /**
     * Скачивает плагин с платформы.
     * Возвращает результат скачивания.
     *
     * @param string $vendor Вендор
     * @param string $package Пакет (плагин)
     * @param string $version Версия пакета
     * @return bool
     */
    public static function downloadPlugin(string $vendor, string $package, string $version)
    {
        $platform_url = rtrim(env('CORS_ALLOWED_ORIGIN_PLATFORM'), '/');
        $plugin_url = $platform_url . "/storage/plugins/{$vendor}/{$package}/{$version}/{$package}.zip";

        if (!is_dir(storage_path("temp/plugins/{$vendor}"))) {
            mkdir(storage_path("temp/plugins/{$vendor}"));
        }
        $save_path = storage_path("temp/plugins/{$vendor}/{$package}.zip");

        return static::downloadPluginFromUrl($plugin_url, $save_path);
    }

    /**
     * Устанавливает плагин
     *
     * @param string $vendor Вендор
     * @param string $package Пакет (плагин)
     * @param string $version Версия пакета
     * @throws \Exception
     */
    public static function installPlugin(string $vendor, string $package, string $version)
    {
        $plugin_file_path = storage_path("temp/plugins/{$vendor}/{$package}.zip");

        if (!file_exists($plugin_file_path)) {
            $downloadResult = static::downloadPlugin($vendor, $package, $version);
        } else {
            $downloadResult = true;
        }

        if (!$downloadResult) {
            // TODO add error logging and custom exceptions
            throw new \Exception('Plugin has not been downloaded');
        }

        $zip = new \ZipArchive();
        $extractResult = false;
        if ($zip->open($plugin_file_path) === true) {
            if (!is_dir(app_path("Plugins/{$vendor}"))) {
                mkdir(app_path("Plugins/{$vendor}"));
            }
            if (!is_dir(app_path("Plugins/{$vendor}/{$package}"))) {
                mkdir(app_path("Plugins/{$vendor}/{$package}"));
            }

            $extractResult = $zip->extractTo(app_path("Plugins/{$vendor}/{$package}"));
            $zip->close();
        }

        if (!$extractResult) {
            // TODO add error logging and custom exceptions
            throw new \Exception('Plugin has not been extracted');
        }

        //TODO add removing file folder
        unlink($plugin_file_path);
    }

    /**
     * Удаляет плагин
     *
     * @param string $vendor Вендор
     * @param string $package Пакет (плагин)
     * @return bool
     */
    public static function deletePlugin(string $vendor, string $package)
    {
        $pluginPath = app_path("Plugins/{$vendor}/{$package}/");
        if (!file_exists($pluginPath)) {
            return false; // если плагина нет - то плагин не был удален
        }
        static::deleteFiles($pluginPath);
        return !file_exists($pluginPath); // результат удаления плагина - отсутствие его папки
    }

    /**
     * Удаляет папку со всеми файлами внутри рекурсивно.
     * Так же может просто удалить указаный файл.
     *
     * @param string $target Путь к папке или файлу
     */
    private static function deleteFiles(string $target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                static::deleteFiles($file);
            }

            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }

    /**
     * Обновляет плагин
     *
     * @param string $vendor Вендор
     * @param string $package Пакет (плагин)
     * @param string $version Версия пакета (версия нового плагина)
     */
    public static function updatePlugin(string $vendor, string $package, string $version)
    {
        $pluginPath = app_path("Plugins/{$vendor}/{$package}");
        if (file_exists($pluginPath)) {
            $pluginDeleted = static::deletePlugin($vendor, $package);
        } else {
            $pluginDeleted = true;
        }

        if ($pluginDeleted) {
            try {
                static::installPlugin($vendor, $package, $version);
            } catch (\Exception $e) {
                Log::error('Plugin has not been installed (when updating)', [
                    'message' => $e->getMessage(),
                    'vendor' => $vendor,
                    'package' => $package,
                    'version' => $version,
                ]);
            }
        }
    }
}
