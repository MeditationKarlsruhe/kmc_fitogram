<?php

namespace Includes\Pages;

class Admin extends \Includes\Base\BaseController
{
    public function register()
    {
        add_action('admin_menu', array($this, 'addAdminPages'));
    }

    public function addAdminPages()
    {
        add_menu_page(
            'KMC Fitogram',
            'KMC Fitogram',
            'manage_options',
            'kmc_fitogram',
            array($this, 'adminIndex'),
            'dashicons-store',
            110
        );
    }

    public function adminIndex()
    {
        require_once $this->pluginPath . 'templates/admin.php';
    }
}
