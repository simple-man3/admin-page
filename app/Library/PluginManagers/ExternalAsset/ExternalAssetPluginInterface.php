<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 14.09.2019
 * Time: 15:38
 */

namespace App\Library\PluginManagers\ExternalAsset;


interface ExternalAssetPluginInterface
{
    public function GetHTML(): string;
}
