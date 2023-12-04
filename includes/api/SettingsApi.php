<?php
/**
 * @package  AlecadddPlugin
 */
namespace Includes\Api;

class SettingsApi
{
    public $adminPages = array();
    public $settings = array();

    public $sections = array();

    public $fields = array();

    public function register()
    {
        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_action('admin_init', array($this, 'registerCustomFields'));
    }

    public function addPages(array $pages)
    {
        $this->adminPages = $pages;

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->adminPages as $adminPage) {
            add_menu_page(
                $adminPage['page_title'],
                $adminPage['menu_title'],
                $adminPage['capability'],
                $adminPage['menu_slug'],
                $adminPage['callback'],
                $adminPage['icon_url'],
                $adminPage['position']
            );
        }
    }

    public function setSettings(array $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function setSections(array $sections)
    {
        $this->sections = $sections;

        return $this;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        foreach ($this->settings as $setting) {
            register_setting(
                $setting["option_group"],
                $setting["option_name"],
                (isset($setting["callback"]) ? $setting["callback"] : '')
            );
        }

        foreach ($this->sections as $section) {
            add_settings_section(
                $section["id"],
                $section["title"],
                (isset($section["callback"]) ? $section["callback"] : ''),
                $section["page"]
            );
        }

        foreach ($this->fields as $field) {
            add_settings_field(
                $field["id"],
                $field["title"],
                (isset($field["callback"]) ? $field["callback"] : ''),
                $field["page"],
                $field["section"],
                (isset($field["args"]) ? $field["args"] : '')
            );
        }
    }

}