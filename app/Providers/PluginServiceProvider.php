<?php

namespace App\Providers;

use App\Library\PluginSystem\AbstractPlugin;
use App\Library\PluginSystem\AbstractPluginManager;
use App\Library\ReflectionHelper\ReflectionHelper;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    protected $pluginsDir = 'Plugins';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $plugins_path = app_path('Plugins');
        $php_files = $this->rglob($plugins_path . '/*.php');
        $reflectionHelper = new ReflectionHelper();
        foreach ($php_files as $php_file) {
            try {
                $refelctionClass = new \ReflectionClass($reflectionHelper->getClassFullNameFromFile($php_file));
                if ($refelctionClass->getParentClass()->getName() == AbstractPlugin::class) {
                    /** @var AbstractPlugin $plugin */
                    $plugin = $reflectionHelper->getClassObjectFromFile($php_file);
                    /** @var AbstractPluginManager $plugin_manager */
                    $pm_class = $plugin->GetPluginManager();
                    $plugin_manager = new $pm_class;
                    $plugin_manager::$plugins = array_merge($plugin_manager::$plugins, [$plugin]);
                }
            } catch (\Exception $exception) {
                // TODO add logging and resolve error on checking php files without classes (e.g. html/blade templates)
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    // todo remove
    // https://stackoverflow.com/questions/24783862/list-all-the-files-and-folders-in-a-directory-with-php-recursive-function/24784144
    public function getDirContents($dir, &$results = []){
        $files = scandir($dir);

        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    // https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
    public function rglob($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
            $files = array_merge($files, $this->rglob($dir.'/'.basename($pattern), $flags));
        }
        return $files;
    }

    // todo remove
    // https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
    public function rsearch($folder, $pattern) {
        $dir = new \RecursiveDirectoryIterator($folder);
        $ite = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($ite, $pattern, \RegexIterator::GET_MATCH);
        $fileList = [];
        foreach($files as $file) {
            $fileList = array_merge($fileList, $file);
        }
        return $fileList;
    }
}
