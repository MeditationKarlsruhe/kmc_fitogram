<?php

namespace Includes\Api\Callbacks;

class AdminCallbacks extends \Includes\Base\BaseController
{
    public function adminDashboard()
    {
        return require_once "$this->pluginPath/templates/admin.php";
    }

    public function defaultOptionGroup($input)
    {
        return $input;
    }

    public function alecadddAdminSection()
    {
        echo 'Check this beautiful section!';
    }

    public function providerId()
    {
        $value = esc_attr(get_option('provider_id'));
        echo '<input type="text" class="regular-text" name="provider_id" value="' . $value . '" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">';
    }

    public function generalEventLayout()
    {
        $value = esc_attr(get_option('general_event_layout'));
        wp_editor(
            $value,
            'fitogram_id',
            array(
                'textarea_name' => 'general_event_layout',
                'textarea_rows' => 10,
            )
        );
    }
}
