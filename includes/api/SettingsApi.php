<?php
/**
 * @package  AlecadddPlugin
 */
namespace Includes\Api;

class SettingsApi
{
    public $adminPages = [];
    public $settings = [];
    public $sections = [];
    public $fields = [];
    public $shortCodes = [];

    public function register()
    {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_init', [$this, 'registerCustomFields']);
        add_action('init', [$this, 'registerShortCodes']);
    }

    public function setShortCodes(array $shortCodes)
    {
        $this->shortCodes = $shortCodes;

        return $this;
    }

    public function setPages(array $pages)
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
                $setting["callback"] ?? ''
            );
        }

        foreach ($this->sections as $section) {
            add_settings_section(
                $section["id"],
                $section["title"],
                $section["callback"] ?? '',
                $section["page"]
            );
        }

        foreach ($this->fields as $field) {
            add_settings_field(
                $field["id"],
                $field["title"],
                $field["callback"] ?? '',
                $field["page"],
                $field["section"],
                $field["args"] ?? ''
            );
        }
    }

    public function registerShortCodes()
    {
        foreach ($this->shortCodes as $shortCode) {
            add_shortcode($shortCode["name"], $shortCode["callback"]);
        }
    }
}
