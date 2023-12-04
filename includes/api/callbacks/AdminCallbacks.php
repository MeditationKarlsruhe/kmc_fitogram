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

    public function fitogramId()
    {
        $value = esc_attr(get_option('fitogram_id'));
        echo '<input type="text" class="regular-text" name="fitogramId" value="' . $value . '" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">';
    }
}
