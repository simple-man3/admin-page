<?php


namespace App\Library\Common;


class Env
{
    /**
     * Устанавливает значение в файл .env
     * Если ключа $key нет в .env файле, то он будет автоматически добавлен,
     * в ином случае - существующее значение будет заменено на $value.
     *
     * @param string $key Ключ
     * @param string $value Значение
     */
    public static function set($key, $value)
    {
        $env_path = app()->environmentFilePath();
        $env_content = file_get_contents($env_path);

        if (strpos($env_content, $key) === false) {
            static::append($env_content, $key, $value);
        } else {
            static::replace($env_content, $key, $value);
        }

        file_put_contents($env_path, $env_content);
    }

    /**
     * Добавляет запись в конец файла
     *
     * @param string $content Содержимое .env
     * @param string $key Ключ
     * @param string $value Значение
     */
    private static function append(&$content, $key, $value)
    {
        if (preg_match('/\R$/', $content) == 0){
            $content .= "\n";
        }
        $content .= "{$key}={$value}\n";
    }

    /**
     * заменяет знаение в файле
     *
     * @param string $content Содержимое .env
     * @param string $key Ключ
     * @param string $value Значение
     */
    private static function replace(&$content, $key, $value)
    {
        $replacement = "{$key}={$value}";
        $result = preg_replace("/{$key}=.*/", $replacement, $content);
        if ($result) {
            $content = $result;
        }
    }
}
