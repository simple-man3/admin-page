<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:44
 */

namespace App\Plugins\PressStartOfficial\VK_share;


use App\Library\PluginManagers\ExternalAsset\AbstractExternalAssetPlugin;
use App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager;

class VKShareButton extends AbstractExternalAssetPlugin
{
    public $position = AbstractExternalAssetPlugin::POS_CUSTOM;
    public $position_section = 'share_post_section';

    /**
     * Возвращает класс менеджера, к которому нужно подключить плагин
     *
     * @return string
     */
    public function GetPluginManager(): string
    {
        return ExternalAssetPluginManager::class;
    }

    public function GetHTML(): string
    {
        return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR .  'button_container.html');
    }
}
