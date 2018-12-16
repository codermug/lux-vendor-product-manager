<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 1:11 PM
 */

namespace App\Models;
use App\Models\AttachmentModel;
use App\Inc\CurrencyManager;
class ProductModel
{
    private static $table           = 'wp_lux_posts';
    public         $validate_errors = "";

  
    public function insert($data) {
        
       // print_r($data);
        // insert attachment 
        $allimages  = [];
        $attachment = new AttachmentModel();
        $currency   = new CurrencyManager();
        foreach ($data["attachments"] as $value) {
           
            $allimages[] = $attachment->insert($value);
        }
        /** Insert thumbnail */
       
        $user_id   =  wp_get_current_user()->ID;
        $attach_id =  $attachment->insert($data['thumbnail']);
        
         //Create post
        $post      = array(
                        'post_author' => $user_id,
                        'post_content' => $data['pdescription'],
                        'post_status' => "pending",
                        'post_title'  => $data['pname'],
                        'post_parent' => '',
                        'post_type' => "product",
                );
       $post_id   = wp_insert_post( $post, $wp_error );
        
        
        set_post_thumbnail( $post_id, $attach_id );
        update_post_meta($post_id, '_product_image_gallery', implode(',',$allimages) );


        update_post_meta( $post_id, '_weight', $data['we']);
        update_post_meta( $post_id, '_length', "" );
        update_post_meta( $post_id, '_width', $data['wi'] );
        update_post_meta( $post_id, '_height', $data['he'] );

        update_post_meta( $post_id, '_sku', "");
        // currency details
        update_post_meta( $post_id, '_lux_product_current_currency', $currency->get_current_currency());
        update_post_meta( $post_id, '_lux_product_current_rate',     $currency->get_current_currency_rate());
        update_post_meta( $post_id, '_lux_product_current_price',  $data['pr']);

        
        $price_gbp = $data['pr'];

        if($currency->get_current_currency() != "GBP"){
            global $WOOCS;
           $price_gbp = $WOOCS->back_convert($data['pr'], $currency->get_current_currency_rate(),2);
        }
        update_post_meta( $post_id, '_regular_price', $price_gbp);
        update_post_meta( $post_id, '_price'        , $price_gbp );

        
        update_post_meta( $post_id, '_visibility', 'visible' );
        update_post_meta( $post_id, '_stock_status', 'instock');
        update_post_meta( $post_id, '_stock', "1" );

        update_post_meta( $post_id, 'total_sales', '0');
        update_post_meta( $post_id, '_downloadable', 'no');
        update_post_meta( $post_id, '_virtual', 'no');
        update_post_meta( $post_id, '_authenticity', '');
        update_post_meta( $post_id, 'authenticity', '');       
        update_post_meta( $post_id, '_sale_price', "" );
        update_post_meta( $post_id, '_purchase_note', "" );
        update_post_meta( $post_id, '_featured', "no" );
        update_post_meta( $post_id, '_sale_price_dates_from', "" );
        update_post_meta( $post_id, '_sale_price_dates_to', "" );
        update_post_meta( $post_id, '_sold_individually', "no" );
        update_post_meta( $post_id, '_manage_stock', "yes" );
        update_post_meta( $post_id, '_backorders', "no" );

      

        $this->_attach_category ($post_id,$data['ct']);
        $this->_attach_brand    ($post_id,$data['bd']);
        $this->_attach_condition($post_id,$data['cnd']);
        $this->_attach_materials($post_id,$data['mt']);
        $this->_attach_colors   ($post_id,$data['color']);
        $this->_attach_gender   ($post_id,$data['gn']);
      

     

          $thedata = Array(
            'pa_condition'=>Array(
                'name'=>'pa_condition',
                'value'=> $data['cnd'],
                'is_visible' => '1',
                'is_taxonomy' => '1'
            ),

            'pa_materials'=>Array(
                'name'=>'pa_materials',
                'value'=>$data['mt'],
                'is_visible' => '1',
                'is_taxonomy' => '1'
            ),
              'pa_gender'=>Array(
                    'name'=>'pa_gender',
                    'value'=> $data['gn'],
                    'is_visible' => '1',
                    'is_taxonomy' => '1'
                ),
                
                'pa_colour'=>Array(
                    'name'=>'pa_colour',
                    'value'=>$data['color'],
                    'is_visible' => '1',
                    'is_taxonomy' => '1'
                ),
               
          );
          update_post_meta( $post_id,'_product_attributes',$thedata); 
        
        //_yoast_wpseo_primary_product_cat
    }

    // return false if error 
    // return true if ok  
    public function valid($data) {
        $msg = '';
       // validate category
       // validate isset

       if(empty($data['pname'])) {
        
            $msg = "\n Product name has not been added";
       }

       if(empty($data['pdescription'])) {
        
        $msg .= "\n Product description has not been added";
       }

       if(!intval($data['ct'])) {
        
           $msg .= "\n Catageory has not been selected";
       }
       if(!intval($data['bd'])) {
          
           $msg .= "\n Select a brand name";
       }
       if(!intval($data['mt'])) {
          
           $msg .= "\n Select product material";
       }
       if(empty($data['color'])) {
          
           $msg .= "\n Select product Color";
       }
       if(!intval($data['cnd'])) {
         
           $msg .= "\n Select product Condition";
       }
       if(!intval($data['gn'])) {
            $msg .= "\n Gender has not been selected";
       }
       if(!is_numeric($data['we'])) {
        $msg .= "\n Weight has not been added";
       }
       if(!is_numeric($data['wi'])) {
        $msg .= "\n Width has not been added";
       }

       if(!is_numeric($data['he'])) {
        $msg .= "\n Height has not been added";
       }
       if(!is_numeric($data['pr'])) {
        $msg .= "\n Price not valid, please enter in numric format";
       }


       // validate attachments
       if(isset($data['attachments'])) {
            foreach($data['attachments'] as $file) {
                if( ! $this->_validate_extention($file)) {
                    $msg .= "\n Attached photo not allowed file:". basename( $file );
                }
            }
        }else {
            $msg .= "\n Upload Required photo ";
        }

      if ($msg !=='') {

           $this->validate_errors = $msg;        
           return false;
      }
      return true;

    }

    private function _attach_category($post_id,$category_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$category_id),array( '%d', '%d'));
    }

    private function _attach_brand($post_id,$brand_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$this->get_term_texanomy_id($brand_id,"brand")),array( '%d', '%d'));
    }
    private function _attach_condition($post_id,$cnd_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$this->get_term_texanomy_id($cnd_id,"pa_condition")),array( '%d', '%d'));
    }
    private function _attach_materials($post_id,$mt_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$this->get_term_texanomy_id($mt_id,"pa_materials")),array( '%d', '%d'));
    }
    private function _attach_colors($post_id,$color_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$this->get_term_texanomy_id($color_id,"pa_colour")),array( '%d', '%d'));
    }

    private function _attach_gender($post_id,$gender_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$this->get_term_texanomy_id($gender_id,"pa_gender")),array( '%d', '%d'));
    }


    private function get_term_texanomy_id($term_id,$taxonomy) {
        global $wpdb;
        $r =  $wpdb->get_results( "SELECT * FROM wp_term_taxonomy WHERE  term_id =".$term_id . " and taxonomy='".$taxonomy."'");
        
        if(isset($r[0]))
          return $r[0]->term_taxonomy_id; 
        return 0;  

    }
    // remove them to single file 
    private function _validate_extention($file) {

        // Set an array containing a list of acceptable formats
        $allowed_file_types = array('jpg','jpeg','gif','png');
         $file_type = pathinfo($file, PATHINFO_EXTENSION);
        // If the uploaded file is the right format
        if (! in_array($file_type, $allowed_file_types))
            
            return false;

        return true;

    }

    

}