<?php

namespace Includes\Pages;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

    public $settings;
    public $callbacks;

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->settings
            ->addPages($this->getPages())
            ->setSettings($this->getSettings())
            ->setSections($this->getSections())
            ->setFields($this->getFields())
            ->register();
    }

    public function getPages()
    {
        return array(
            array(
                'page_title' => 'KMC Fitogram',
                'menu_title' => 'KMC Fitogram',
                'capability' => 'manage_options',
                'menu_slug' => 'kmc_fitogram',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function getSettings()
    {
        return array(
            array(
                'option_group' => 'kmc_fitogram_options_group',
                'option_name' => 'fitogram_id',
                'callback' => array($this->callbacks, 'defaultOptionGroup')
            )
        );
    }

    public function getSections()
    {
        return array(
            array(
                'id' => 'kmc_fitogram_admin_index',
                'title' => 'Einstellungen',
                'page' => 'kmc_fitogram'
            )
        );
    }

    public function getFields()
    {
        return array(
            array(
                'id' => 'fitogram_id',
                'title' => 'Fitogram ID',
                'callback' => array($this->callbacks, 'fitogramId'),
                'page' => 'kmc_fitogram',
                'section' => 'kmc_fitogram_admin_index',
                'args' => array(
                    'label_for' => 'fitogramId',
                    'class' => 'example-class'
                )
            ),
        );
    }
}
