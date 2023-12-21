<?php


namespace Includes\Base;

class EnqueueController extends BaseController
{
    public function register()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style('kmc-fitogram-styles', $this->pluginUrl."assets/kmc-fitogram-styles.css?hash=06");
    }
}
