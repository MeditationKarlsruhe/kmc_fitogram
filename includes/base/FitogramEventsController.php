<?php

namespace Includes\Base;

class FitogramEventsController extends BaseController
{
    public function getEventGroups(string $color)
    {
        $providerId = get_option('provider_id');
        $response = wp_remote_get(
            "https://kmcfitogram.azurewebsites.net/api/Events?providerId=$providerId&color=$color"
        );
        $body = wp_remote_retrieve_body($response);

        return json_decode($body);
    }
}
