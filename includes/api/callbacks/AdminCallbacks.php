<?php

namespace Includes\Api\Callbacks;

use Includes\Base\BaseController;
use Includes\Base\FitogramEventsController;

class AdminCallbacks extends BaseController
{
    private FitogramEventsController $fitogramEventsController;
    public function __construct()
    {
        parent::__construct();
        $this->fitogramEventsController = new FitogramEventsController();
    }

    public function fitogramEventsShortCode(array $args)
    {
        ob_start();

        $color = $args['color'];
        $showImage = ($args['show-image'] ?? 'true') === 'true';
        $eventGroups = $this->fitogramEventsController->getEventGroups($color);

        require_once "$this->pluginPath/templates/fitogram-events.php";

        return ob_get_clean();
    }

    public function adminDashboard()
    {
        return require_once "$this->pluginPath/templates/admin.php";
    }

    public function defaultOptionGroup($input)
    {
        return $input;
    }

    public function providerId()
    {
        $value = esc_attr(get_option('provider_id'));
        echo '<input type="text" class="regular-text" name="provider_id" value="' . $value . '" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">';
    }
}
