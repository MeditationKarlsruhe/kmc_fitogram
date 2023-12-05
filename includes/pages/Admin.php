<?php

namespace Includes\Pages;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public SettingsApi $settingsApi;
    public AdminCallbacks $adminCallbacks;

    public function register()
    {
        $this->settingsApi = new SettingsApi();
        $this->adminCallbacks = new AdminCallbacks();

        $this->settingsApi
            ->setPages($this->getPages())
            ->setSettings($this->getSettings())
            ->setSections($this->getSections())
            ->setFields($this->getFields())
            ->setShortCodes($this->getShortCodes())
            ->register();
    }

    private function getShortCodes()
    {
        return [
            [
                'name' => 'fitogram-events',
                'callback' => [$this->adminCallbacks, 'fitogramEventsShortCode']
            ]
        ];
    }

    public function getPages()
    {
        return [
            [
                'page_title' => 'KMC Fitogram',
                'menu_title' => 'KMC Fitogram',
                'capability' => 'manage_options',
                'menu_slug' => 'kmc_fitogram',
                'callback' => [$this->adminCallbacks, 'adminDashboard'],
                'icon_url' => 'dashicons-schedule',
                'position' => 110
            ]
        ];
    }

    public function getSettings()
    {
        return [
            [
                'option_group' => 'kmc_fitogram_options_group',
                'option_name' => 'fitogram_provider_id',
                'callback' => [$this->adminCallbacks, 'defaultOptionGroup']
            ],
            [
                'option_group' => 'kmc_fitogram_options_group',
                'option_name' => 'fitogram_studio_name',
                'callback' => [$this->adminCallbacks, 'defaultOptionGroup']
            ]
        ];
    }

    public function getSections()
    {
        return [
            [
                'id' => 'kmc_fitogram_admin_index',
                'title' => 'Einstellungen',
                'page' => 'kmc_fitogram'
            ]
        ];
    }

    public function getFields()
    {
        return [
            [
                'id' => 'fitogram_provider_id',
                'title' => 'Fitogram Provider ID',
                'callback' => [$this->adminCallbacks, 'fitogramProviderId'],
                'page' => 'kmc_fitogram',
                'section' => 'kmc_fitogram_admin_index',
                'args' => [
                    'label_for' => 'fitogram_provider_id',
                ],
            ],
            [
                'id' => 'fitogram_studio_name',
                'title' => 'Fitogram Studio Name',
                'callback' => [$this->adminCallbacks, 'fitogramStudioName'],
                'page' => 'kmc_fitogram',
                'section' => 'kmc_fitogram_admin_index',
                'args' => [
                    'label_for' => 'fitogram_studio_name',
                ],
            ]
        ];
    }
}
