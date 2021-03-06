<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 3:47 PM
 */

namespace App\Controllers;


use App\Inc\DataService;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\AttachmentModel;

class FrontController
{
    public function register() {


        //add_action( 'wp_ajax_nopriv_lux_vendor_get_materials', [$this,'getJsonMaterials'] );
        add_action( 'wp_ajax_lux_vendor_get_materials', [$this,'getJsonMaterials'] );
        add_action( 'wp_ajax_nopriv_lux_vendor_get_materials', [$this,'getJsonMaterials'] );
        add_action( 'wp_ajax_lux_vendor_clpe', [$this,'calculatePrice'] );

        add_action( 'wp_ajax_md_upfls_save',[$this,'md_upload_photos_save'] );
        add_action( 'wp_ajax_nopriv_md_upfls_save',[$this,'md_upload_photos_save'] );

        add_action( 'wp_ajax_md_pfm_save',[$this,'md_post_product_save'] );
        add_action( 'wp_ajax_nopriv_md_pfm_save',[$this,'md_post_product_save'] );
    }

    function calculatePrice()
    {

        // validate nonce
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
            exit("No naughty business please");
        }
        echo json_encode(['p'=>5000]);

        die();exit();
        //get

    }

   
    static function dashboard()
    {
        // Double check user capabilities
        $user = wp_get_current_user();
      
        //if ( in_array( 'dc_vendor', (array) $user->roles ) ) {
            $currency_symbol = get_woocommerce_currency_symbol();
            $currency = get_woocommerce_currency();
            _includes('front/dashboard.php',['currency_symbol'=>$currency_symbol,'currency'=>$currency]);
        //}else {

            echo "<br>Please contact administration in order to become a vendor";
        //}

      
    }

    public function md_upload_photos_save(){
      
        $attachment = new AttachmentModel();

        $result = $attachment->upload();
        
        $this->_return_json($result);
    }

    public function md_post_product_save(){
       
       
            
             // validate data
             // insert attachments
             // insert product
             // attach attachment to the product 
             // attach meta to the product

          if(isset($_POST['dt'])) {

            
             parse_str($_POST['dt'],$data);

           

             if($msg = $this->_nonce_validate($data)) {
                $this->_return_json(['msg'=>$msg],'error');
             }

             $product = new ProductModel();
             if(! $product->valid($data)) {
                $this->_return_json(['msg'=>$product->validate_errors],'error');
             }
            
              
             
              $product->insert($data);
              $this->_return_json(['msg'=>'product addedd successfully'],'success');
              
              
          }

     }

     private function _return_json($data,$status="") {
        if($status) {
          
            $data['status']=$status;
         
        }
        echo json_encode($data);
        die();
       
     }

     private function _nonce_validate($data) {
        if ( !wp_verify_nonce( $data['my_user_vote_n'], "my_user_vote_nonce")) {
            return "No naughty business please";
        }
     }

     /** return the msg if data not valid 
      *  otherwise return true */
    
    
   


   
}