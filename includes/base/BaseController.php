<?php

namespace Includes\Base;

class BaseController
{

    public $pluginName;
    public $pluginPath;
    public $pluginUrl;

    public function __construct()
    {
        $this->pluginName = plugin_basename(dirname( __FILE__, 3)) . '/kmc_fitogram.php';
        $this->pluginPath = plugin_dir_path(dirname( __FILE__, 2));
        $this->pluginUrl = plugin_dir_url(dirname(__FILE__, 2));
    }
}
