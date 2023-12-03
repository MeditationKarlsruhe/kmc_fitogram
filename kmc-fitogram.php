<?php
/*
Plugin Name: Fitogram
Description: Loads and displays events from Fitogram.
Version: 1.0
Author: Felix
*/

defined('ABSPATH') or die;

// require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
// require_once 'eventProvider.php';


class KmcFitogram
{
  public $pluginName;

  public function __construct()
  {
    $this->pluginName = plugin_basename(__FILE__);
  }
  function register()
  {
    add_action('admin_menu', array($this, 'addAdminPages'));
    add_filter("plugin_action_links_$this->pluginName", array($this, 'settingsLink'));
  }
  function addAdminPages()
  {
    add_menu_page(
      'KMC Fitogram',
      'KMC Fitogram',
      'manage_options',
      'kmc_fitogram',
      array($this, 'adminIndex'),
      'dashicons-store',
      110
    );
  }

  function settingsLink(array $links)
  {
    $settingsLink = '<a href="admin.php?page=fitogram">Einstellungen</a>';
    array_push($links, $settingsLink);
    return $links;
  }
  function adminIndex()
  {
    require_once plugin_dir_path(__FILE__) . '/templates/admin.php';
  }

}

// Add shortcode function here
// function fitogramShortcode($atts)
// {
//   $eventProvider = new Fitogram\FitogramEventProvider();
//   $uff = $eventProvider->provide('#' . $atts["color"]);
//   $off =\Fitogram\ transform($uff);
//   echo implode(", ", $uff);

//   //     $eventsResponse = file_get_contents("https://kmcfitogram.azurewebsites.net/api/Events?color={$atts['color']}");

//   //     $eventGroups = json_decode($eventsResponse, true);
// //     $eventGroupsHtml = [];

//   //     foreach ($eventGroups as $eventGroup) {
// //         $productHtml = [];

//   //         foreach ($eventGroup["events"][0]["products"] as $product) {
// //             $productAmount = number_format($product['amount'], 2);
// //             $productHtml[] = "<div><strong>{$product['name']}:</strong> {$productAmount} {$product['currencySymbol']} ({$product['displaySalesPriceRhythm']})</div>";
// //         }

//   //         $eventsHtml = [];
// //         foreach ($eventGroup["events"] as $event) {
// //             $dateFormatter = new IntlDateFormatter('de_DE', IntlDateFormatter::FULL, IntlDateFormatter::FULL, $event["timeZoneId"]);
// //             $dateFormatter->setPattern("EEEE, d. MMMM y");

//   //             $timeFormatter = new IntlDateFormatter('de_DE', IntlDateFormatter::FULL, IntlDateFormatter::FULL, $event["timeZoneId"]);
// //             $timeFormatter->setPattern("HH:mm");

//   //             $start = strtotime($event["start"]);
// //             $end = strtotime($event["end"]);
// //             $eventsHtml[] = "<div><span style='width: 275px; display: inline-block;'>{$dateFormatter->format($start)}</span><span style='width: 150px; display: inline-block;'> {$timeFormatter->format($start)} - {$timeFormatter->format($end)}</span><a target='_blank' title='Anmeldung zum Kurs' rel='noopener' href='https://widget.fitogram.pro/menlha-zentrum/?w=/event/{$event["id"]}'>Anmeldung</a></div>";
// //         }
// //         $eventProducts = implode("", $productHtml);
// //         $events = implode("", $eventsHtml);
// //         $eventGroupsHtml[] = "
// //    <div style='margin-bottom: 200px'>     
// //       <div style='display: flex'>
// //       <img src='{$eventGroup["imageUrl"]}' style='width: 66%;margin: 0 auto 50px auto;' />
// //      </div>

//   //      <div style='display: flex'>
// //      <div style='flex-basis: 66.66%;'>
// //       <h2>{$eventGroup["name"]}</h2>
// //    {$eventGroup["content"]}
// //    {$events}
// //      </div>

//   //      <div  style='flex-basis: 33.33%;'>
// //       <div class='avia_textblock' itemprop='text' style='margin-bottom: 10px;'>

//   // </div>
// //      <div  style='flex-basis: 33.33%;'>
// // {$eventProducts}
// // </div>
// //    </div>

//   //    </div>
// //       </div> ";
// //     }

//   //     return implode("", $eventGroupsHtml);
// }

// add_shortcode('fitogram', 'fitogramShortcode');

$kmcFiotgram = new KmcFitogram();
$kmcFiotgram->register();

// register_activation_hook(__FILE__, array($kmcFiotgram, 'registerActivationHook'));