<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 11:35 AM
 */

namespace App\Inc;

use App\Controllers\FrontController;
use App\Controllers\AdminController;

class AdminSetting
{
    private $shortcode_name = 'luxVendor';

    public function register() {

       
        
        if (isset($_GET['page']) &&  ($_GET['page'] == 'lux-vendor-manager' || $_GET['page'] == 'lux-vendor-manager_categories' )) {
                 add_action( 'admin_enqueue_scripts', [$this, 'scripts'] );
        }
        add_action( 'admin_menu', [$this,'plugin_admin_menu'] );
        add_shortcode( $this->shortcode_name, [FrontController::class, 'dashboard'] );
    }
    public  function scripts() {
        wp_enqueue_script("jquery");

        wp_register_script( 'salam-vue', plugins_url('lux-vendor-product-manager/assets/js/vue.js'), [], '2.5.16' );
        wp_enqueue_script('salam-vue');

        wp_register_script( 'salam-bootstrap-js', plugins_url('lux-vendor-product-manager/assets/js/bootstrap.min.js') );
        wp_enqueue_script('salam-bootstrap-js');

        wp_enqueue_style( 'salam-bootstrap',   plugins_url('lux-vendor-product-manager/assets/css/bootstrap.min.css'));

        wp_enqueue_style( 'salam-datatable-css', plugins_url('lux-vendor-product-manager/assets/css/jquery.dataTables.css') );
        wp_register_script( 'salam-datatable-js', plugins_url('lux-vendor-product-manager/assets/js/jquery.dataTables.js') );
        wp_enqueue_script('salam-datatable-js');

        wp_register_script( 'salam-vendor-admin-custom',plugins_url('lux-vendor-product-manager/assets/js/admin-app.js') ,array('jquery'), '1.1', false);
        
        

        // Localize the script with new data
        $data_array = array(
            'nonce'     => wp_create_nonce( 'nds_admin_nonce' ),
            'materials'    =>  \App\Inc\DataService::wooCommerceMaterials(),
           
        );
        wp_localize_script( 'salam-vendor-admin-custom', 'data_array', $data_array );
        wp_enqueue_script('salam-vendor-admin-custom');


    }

    public  function plugin_admin_menu()
    {
        $adminController = new AdminController();
        add_menu_page(
            'Vendor Manager',
            'Vendor Manager ',
            'manage_options',
            'lux-vendor-manager',
            [$adminController,'dashboard'],
            'dashicons-wordpress-alt',
            5
        );
        add_submenu_page(
            'lux-vendor-manager',
            'Categories',
            'Categories',
            'manage_options',
            'lux-vendor-manager_categories',
            [$adminController,'route'],
            'dashicons-wordpress-alt',
            5
        );
        add_submenu_page(
            'lux-vendor-manager',
            'Product Manager',
            'Product Manager',
            'manage_options',
            'lux-vendor-manager_products',
            [$adminController,'productsIndex'],
            'dashicons-wordpress-alt',
            5
        );


    }


}