<?php

namespace App\Library\PluginManagers\ExternalAsset;


use App\Library\PluginSystem\AbstractPluginManager;
use App\Library\PluginSystem\UsesPlugins;

class ExternalAssetPluginManager extends AbstractPluginManager
{
    use UsesPlugins;

    /**
     * Возвращает интерфейс для валидации плагинов при загрузке в менеджер плагинов
     *
     * @return string
     */
    public function GetPluginInterface(): string
    {
        return ExternalAssetPluginInterface::class;
    }

    /**
     * Вставка html кода в конец тега body
     *
     * @return string
     */
    public function renderInEdnOfBody()
    {
        $renderedHtml = '';
        /** @var AbstractExternalAssetPlugin $plugin */
        foreach (static::$plugins as $plugin) {
            if ($plugin->position == AbstractExternalAssetPlugin::POS_END_OF_BODY) {
                $renderedHtml .= $plugin->GetHTML();
            }
        }
        return $renderedHtml;
    }

    /**
     * Вставка html кода в тег head
     *
     * @return string
     */
    public function renderInsideHead()
    {
        $renderedHtml = '';
        /** @var AbstractExternalAssetPlugin $plugin */
        foreach (static::$plugins as $plugin) {
            if ($plugin->position == AbstractExternalAssetPlugin::POS_INSIDE_HEAD) {
                $renderedHtml .= $plugin->GetHTML();
            }
        }
        return $renderedHtml;
    }

    /**
     * Вставка html кода в определенное место
     *
     * @param string $section Секция (сетка) куда добавить html код
     * @return string
     */
    public function renderInCustomSection(string $section)
    {
        $renderedHtml = '';
        /** @var AbstractExternalAssetPlugin $plugin */
        foreach (static::$plugins as $plugin) {
            if ($plugin->position == AbstractExternalAssetPlugin::POS_CUSTOM && $plugin->position_section == $section) {
                $renderedHtml .= $plugin->GetHTML();
            }
        }
        return $renderedHtml;
    }
}
