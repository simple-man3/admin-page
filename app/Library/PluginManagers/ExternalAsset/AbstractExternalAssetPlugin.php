<?php
/**
 * Created by PhpStorm.
 * User: reenekt
 * Date: 04.11.2019
 * Time: 12:21
 */

namespace App\Library\PluginManagers\ExternalAsset;


use App\Library\PluginSystem\AbstractPlugin;

abstract class AbstractExternalAssetPlugin extends AbstractPlugin implements ExternalAssetPluginInterface
{
    const POS_END_OF_BODY = 0;
    const POS_INSIDE_HEAD = 1;
    const POS_CUSTOM = 2;

    public $position = self::POS_END_OF_BODY;
    public $position_section = null;
}
