<?php

namespace Includes\Base;

class FitogramEventsController extends BaseController
{
    public function getEventGroups(string $color)
    {
        $providerId = get_option('fitogram_provider_id');
        $studioName = get_option('fitogram_studio_name');

        $response = wp_remote_get(
            "https://kmc-fitogram.azurewebsites.net/api/Events?providerId=$providerId&studioName=$studioName&color=$color", ['timeout'=>30]
        );
        $body = wp_remote_retrieve_body($response);

        return json_decode($body);
    }
}
