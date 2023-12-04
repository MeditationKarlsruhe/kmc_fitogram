<?php

namespace Includes\Pages;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\AdminCallbacks;
use Includes\Base\FitogramEventsController;

class Admin extends BaseController
{

    public $settings;
    public $callbacks;
    public $fitoGramEventsController;

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->fitoGramEventsController = new FitogramEventsController();

        $this->settings
            ->addPages($this->getPages())
            ->setSettings($this->getSettings())
            ->setSections($this->getSections())
            ->setFields($this->getFields())
            ->register();

        $this->addFitogramEventsShortCode();
    }

    private function addFitogramEventsShortCode()
    {
        add_shortcode('fitogram-events', array($this, 'fitogramEventsShortCode'));
    }

    public function fitogramEventsShortCode(array $args)
    {
        ob_start();
        $color = $args['color'];
        $showImage = ($args['show-image'] ?? 'true') === 'true';

        $eventGroups = $this->fitoGramEventsController->getEvents($color);
        require_once "$this->pluginPath/templates/fitogram-events.php";
        return ob_get_clean();
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
                'icon_url' => 'dashicons-schedule',
                'position' => 110
            )
        );
    }

    public function getSettings()
    {
        return array(
            array(
                'option_group' => 'kmc_fitogram_options_group',
                'option_name' => 'provider_id',
                'callback' => array($this->callbacks, 'defaultOptionGroup')
            ),
            array(
                'option_group' => 'kmc_fitogram_options_group',
                'option_name' => 'general_event_layout',
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
                'id' => 'provider_id',
                'title' => 'Fitogram Provider ID',
                'callback' => array($this->callbacks, 'providerId'),
                'page' => 'kmc_fitogram',
                'section' => 'kmc_fitogram_admin_index',
                'args' => array(
                    'label_for' => 'fitogramId',
                    'class' => 'example-class'
                ),
            ),
            array(
                'id' => 'general_event_layout',
                'title' => 'Allgemeines Event Layout',
                'callback' => array($this->callbacks, 'generalEventLayout'),
                'page' => 'kmc_fitogram',
                'section' => 'kmc_fitogram_admin_index',
                'args' => array(
                    'label_for' => 'general_event_layout',
                    'class' => 'example-class'
                )
            ),
        );
    }
}
