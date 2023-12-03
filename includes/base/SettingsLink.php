<?php

namespace Includes\Base;

class SettingsLink extends BaseController
{
    public function register()
    {
        add_filter('plugin_action_links_' . $this->pluginName, array($this, 'addSettingsLink'));
    }

    public function addSettingsLink(array $links)
    {
        $settingsLink = '<a href="admin.php?page=kmc_fitogram">Einstellungen</a>';
        array_push($links, $settingsLink);
        return $links;
    }

}
