<?php
/*
Plugin Name: KMC Fitogram
Description: Lädt Events aus Fitogram und zeigt diese an.
Version: 1.0
Author: Felix Ruthenberg (Kadampa Meditationszentrum Karlsruhe)
*/

defined('ABSPATH') or die;

require_once dirname(__FILE__) . '/vendor/autoload.php';

Includes\Init::registerServices();
