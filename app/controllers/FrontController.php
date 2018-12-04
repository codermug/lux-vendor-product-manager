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

    /*function getJsonMaterials()
    {

        // validate nonce
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
            exit("No naughty business please");
        }

        $materials = CategoryModel::getMaterials($_POST['category_id']);
        echo json_encode($materials);

        die();
        //get

    }*/

    static function dashboard()
    {
        // Double check user capabilities
       // if ( !current_user_can('manage_options') ) {
         //   return;
       // }

      //$data = DataService::wooCommerceCategories(); echo "<pre>"; print_r($data);

       _includes('front/dashboard.php');
    }

    public function md_upload_photos_save(){
      
        $attachment = new AttachmentModel();

        $result = $attachment->upload();
        
       $this->_return_json($result);
    }

    public function md_post_product_save(){
       
        //echo "Post product ..... "; print_r($_POST);print_r($_FILES);

            // validate data
            // insert attachments
             // insert product
             // attach attachment to the product 
             // attach meta to the product

          if(isset($_POST['dt'])) {

              parse_str($_POST['dt'],$data);
              
              $product = new ProductModel();
              $product->insert($data);
              $this->_return_json(['msg'=>'product addedd successfully'],'sucess');
              
              if(! $msg = $product->validate($data)) {
                  $this->_return_json(['msg'=>$msg],'error');
              }
              
             

             
              
          }

     }

     private function _return_json($data,$status="") {
        if($status) {
         array_push($data,['status'=>$status]);
        }
        echo json_encode($data);
        die();
     }

     private function nonce_validate($n) {
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
            exit("No naughty business please");
        }
     }

     /** return the msg if data not valid 
      *  otherwise return true */
    
    
   


   
}