<?php
/*
Plugin Name: luxury vendor product manager
Description: Vendor Manager Plugin
Version: 1.0.0
Contributors: Salam
Author: Salam
Author URI: https://codermug.com
License: GPLv2 or later
Text Domain: lux-vendor-manager
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die("you are not allowed to enter this page");
}
if( !function_exists('add_action')) {
    echo "go back !";
    exit();
}
if(file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

define ('PLUGIN_PATH', plugin_dir_path(__FILE__));
define ('PLUGIN_NAME','lux-vendor-manager');

define ('PLUGIN_SHORTCODE_PAGE','assign-product');

// enable this option when you work in localhost
define ('PLUGIN_SHORTCODE_PAGE','/lux/assign-product/'); 

use App\Inc\Activate;
use App\Inc\Deactivate;
Use App\Inc\DataService;
Use App\Controllers\AdminController;
use App\Start;


//if( ! class_exists( 'App\Start' ) ) {

    $lux_vendor = new App\Start();
    $lux_vendor->register();

    register_activation_hook(__FILE__,[$lux_vendor,'activate']);
    register_deactivation_hook(__FILE__,[$lux_vendor,'deactivate']);
//}

//if (! function_exists('_includes')) {

    function _includes($file,$attr=[]) {


        if(is_array($attr)) {
            extract($attr);

        }


        require PLUGIN_PATH.'app/views/'.$file;
    }
//}

function _lux_admin_url($page,$keys_values="") {
    $path = 'admin.php?page=lux-vendor-manager_'.$page;
    if(isset($keys_values))
        return  add_query_arg($keys_values,admin_url($path));
    return  admin_url($path);
}

?>
