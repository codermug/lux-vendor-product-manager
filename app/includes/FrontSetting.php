<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 11:50 AM
 */

namespace App\Inc;


class FrontSetting
{
    public function register() {
        add_action( 'wp_enqueue_scripts', [$this, 'scripts'] );
    }

    public function scripts() {

        wp_enqueue_script("jquery");

        wp_register_script( 'salam-vue', plugins_url('lux-vendor-product-manager/assets/js/vue.js'), [], '2.5.16' );
        wp_enqueue_script('salam-vue');

        wp_register_script( 'salam-bootstrap-js', plugins_url('lux-vendor-product-manager/assets/js/bootstrap.min.js') );
        wp_enqueue_script('salam-bootstrap-js');

        wp_enqueue_script( 'salam-select2-js', plugins_url('lux-vendor-product-manager/assets/js/select2.full.min.js') );

       // wp_register_script( 'salam-smart_wizard-script',plugins_url('lux-vendor-product-manager/assets/js/jquery.smartWizard.min.js') ,array('jquery'), '1.1', false);
       // wp_enqueue_script('salam-smart_wizard-script');


        wp_register_script( 'salam-uploader-image-loader',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/load-image.all.min.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-image-loader');

        wp_register_script( 'salam-uploader-image-canvas',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/canvas-to-blob.min.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-image-canvas');

        wp_register_script( 'salam-uploader-widget',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/vendor/jquery.ui.widget.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-widget');

        wp_register_script( 'salam-uploader-transport',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/jquery.iframe-transport.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-transport');

        wp_register_script( 'salam-uploader-fileupload',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/jquery.fileupload.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-fileupload');

        wp_register_script( 'salam-uploader-process',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/jquery.fileupload-process.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-process');

        wp_register_script( 'salam-uploader-image',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/jquery.fileupload-image.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-image');

        wp_register_script( 'salam-uploader-validate',plugins_url('lux-vendor-product-manager/assets/js/uploader/js/jquery.fileupload-validate.js') ,array('jquery'), '1.1', false);
        wp_enqueue_script('salam-uploader-validate');


        wp_register_script( 'salam-vendor-custom',plugins_url('lux-vendor-product-manager/assets/js/app.js') ,array('jquery'), '1.1', false);


        // Localize the script with new data
        $data_array = array(
            '_brands'=>DataService::wooCommerceBrands(),
            '_categories'=>DataService::wooCommerceCategories(),
        );
        wp_localize_script( 'salam-vendor-custom', 'data_array', $data_array );
        wp_enqueue_script('salam-vendor-custom');





        //if( has_shortcode( $post->post_content, $this->shortcode_name ) ) {
        wp_enqueue_style( 'salam-bootstrap',   plugins_url('lux-vendor-product-manager/assets/css/bootstrap.min.css'));
        wp_enqueue_style( 'salam-select2-css', plugins_url('lux-vendor-product-manager/assets/css/select2.min.css') );
        wp_enqueue_style( 'salam-smart_wizard',plugins_url('lux-vendor-product-manager/assets/css/smart_wizard.min.css') );
        wp_enqueue_style( 'salam-css',plugins_url('lux-vendor-product-manager/assets/css/custom.css') );






        // }
    }
}