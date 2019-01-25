<?php
/**
* Plugin Name: RiverTheme Core
* Plugin URI: http://www.zootemplate.com/
* Description: This is not just a plugin, it is a package with many tools a website needed.
* Author: Zootemplate
* Version: 2.3.0
* Author URI: http://www.zootemplate.com/
*
* Text Domain: rit-core
*/

//Define global variable
require_once('rit-config.php');
//require_once('rit-setting.php');

require_once('inc/helpers/rit.php');
//require_once('inc/helpers/rit-portfolio-settings.php');
require_once('inc/helpers/vc.php');
require_once('inc/helpers/wc.php');


//Theme customize
require_once('inc/customize/customize.php');

require_once('inc/rit-loader.php');

// Post format
require_once('inc/post-format/post-format.php');

//Sample data
require_once('inc/rit-sample-data/rit-sample-data.php');

//Social counter
//require_once('inc/social-counter/social-counter.php');

//Custom Menu
require_once('inc/menu/menu.php');

//fixed rewrite course to cause . Just call only one time
function rit_core_activate() {
    if(version_compare(RIT_VERSION, '2.0.2') > 0){
        flush_rewrite_rules();
    }
}
register_activation_hook( __FILE__, 'rit_core_activate' );

?>