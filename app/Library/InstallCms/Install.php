<?php

namespace App\Library\InstallCms;

use Illuminate\Support\Facades\App;

class Install
{
    public static function getAccessDb($key)
    {
        //Получаем путь до файла "db_access.json"
        $path=static::getPath();
        $content = json_decode(file_get_contents($path), true);

        return $content[$key];
    }

    public static function setAccessDb($new_request)
    {
        config(['database.connections.mysql.host'=>$new_request['db_host']? $new_request['db_host']: '127.0.0.1']);
        config(['database.connections.mysql.port'=>$new_request['db_port']? $new_request['db_port']: '3306']);
        config(['database.connections.mysql.database'=>$new_request['name_db']]);
        config(['database.connections.mysql.username'=>$new_request['login_db']]);
        config(['database.connections.mysql.password'=>$new_request['db_password']]);

        //Получаем путь до файла "db_access.json"
        $path=static::getPath();
        $content = json_decode(file_get_contents($path), true);

        $content['DB_HOST'] = key_exists('DB_HOST',$new_request)? $new_request['db_host']: "127.0.0.1";
        $content['DB_PORT'] = key_exists('DB_PORT',$new_request)? $new_request['db_port']: "3306";
        $content['DB_DATABASE'] = $new_request['name_db'];
        $content['DB_USERNAME'] = $new_request['login_db'];
        $content['DB_PASSWORD'] = key_exists('db_password',$new_request)? $new_request['db_password']: "";
        $content['DB_INSTALLED'] = true;

        file_put_contents($path, json_encode($content));
    }

    /**
     * отображает путь до проекта
     */
    public static function getPath()
    {
        return base_path('db_access.json');
    }
}
