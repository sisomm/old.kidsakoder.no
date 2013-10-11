<?php

/**
 *  Use Advanced Custom Field as a part of theme
 *
 */

define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

/**
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */

// Add-ons
// include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );

require_once('lkk-custom-fields/lkk-hompage-block-fields.php');
  
require_once("lkk-location/lkk-location-taxonomy.php");
require_once("lkk-location/lkk-location-widgets.php");
require_once("lkk-codeclub/lkk-codeclub-widgets.php");