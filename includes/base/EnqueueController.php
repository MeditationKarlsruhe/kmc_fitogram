<?php


namespace Includes\Base;

class EnqueueController extends BaseController
{
    public function register()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('kmc_fitogram_styles', $this->pluginUrl."assets/kmc-fitogram-styles.css");
    }
}
