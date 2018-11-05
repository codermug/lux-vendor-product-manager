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



if( ! class_exists( 'LuxVendorManager' ) ) {
    class LuxVendorManager {

        private $shortcode_name = 'pollka';

        // trigger methods
        public function register() {
            add_shortcode( $this->shortcode_name, [$this, 'shortcode'] );
            add_action( 'wp_enqueue_scripts', [$this, 'scripts'] );
            add_action( 'admin_enqueue_scripts', [$this, 'scripts'] );
            add_action( 'admin_menu', [$this,'wpplugin_settings_page'] );


        }
        public function shortcode( $atts ) {
            require_once plugin_dir_path(__FILE__).'views/front/dashboard.php';
        }
        // Only enqueue scripts if we're displaying a post that contains the shortcode
        // Register front-end scripts
        public function scripts() {
            global $post;
            //if( has_shortcode( $post->post_content, $this->shortcode_name ) ) {
                wp_enqueue_script( 'salam-vue', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js', [], '2.5.16' );
                //wp_enqueue_script( 'salam-script', plugin_dir_url( __FILE__ ) . 'assets/js/vue-select.js', ['vue'], '2.0', true );
                // wp_enqueue_script( 'salam-script', plugin_dir_url( __FILE__ ) . 'assets/js/salam.js', ['vue'], '0.1', true );
                wp_enqueue_style( 'salam-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', [], '4.1.3' );
                wp_enqueue_script( 'salam-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', [], '4.1.3' );

                wp_enqueue_script( 'salam-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js', [], '2.5.16' );
                wp_enqueue_style( 'salam-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css', [], '4.1' );


               // wp_enqueue_style( 'salam-css', plugin_dir_url( __FILE__ ) . 'css/salam.css', [], '0.1' );
           // }
        }




        function admin_page()
        {
            // Double check user capabilities
            if ( !current_user_can('manage_options') ) {
                return;
            }

            require_once plugin_dir_path(__FILE__).'views/admin/dashboard.php';
        }
        function wpplugin_settings_page()
        {
            add_menu_page(
                'Vendor Product Manager',
                'Vendor Product Manager',
                'manage_options',
                'lux-vendor-manager',
                [$this,'admin_page'],
                'dashicons-wordpress-alt',
                5
            );

        }

       // function activate() { }
       // function deactivate() {}
      //  function uninstall() {}

    }
    (new LuxVendorManager())->register();
}
//register_activation_hook(__FILE__,[]);
//register_deactivation_hook(__FILE__,[]);
?>
