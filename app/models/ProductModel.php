<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 1:11 PM
 */

namespace App\Models;
use App\Models\AttachmentModel;

class ProductModel
{
    private static $table = 'wp_lux_posts';

  
    public function insert($data) {
        
        print_r($data);
        // insert attachment 
        $attachment = new AttachmentModel();
       /* foreach ($data["attachments"] as $value) {
           
            $attachment->insert($value);
        }*/
        /** Insert thumbnail */
       
        $user_id   =  wp_get_current_user()->ID;
        $attach_id =  $attachment->insert($data['thumbnail']);
        $post      = array(
                        'post_author' => $user_id,
                        'post_content' => $data['pdescription'],
                        'post_status' => "pending",
                        'post_title'  => $data['pname'],
                        'post_parent' => '',
                        'post_type' => "product",
                );
        
        //Create post
       
       $post_id   = wp_insert_post( $post, $wp_error );
        
        
        set_post_thumbnail( $post_id, $attach_id );

        update_post_meta( $post_id, '_weight', $data['we']);
        update_post_meta( $post_id, '_length', "" );
        update_post_meta( $post_id, '_width', $data['wi'] );
        update_post_meta( $post_id, '_height', $data['he'] );

        update_post_meta( $post_id, '_sku', "");

        update_post_meta( $post_id, '_regular_price', $data['pr'] );
        update_post_meta( $post_id, '_price',$data['pr']  );

        
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

       // update_post_meta($post_id, '_product_image_gallery', $allimages );


        $this->_attach_category($post_id,$data['ct']);
        $this->_attach_brand($post_id,$data['bd']);
        $this->_attach_condition($post_id,$data['cnd']);
        $this->_attach_materials($post_id,$data['mt']);
        $this->_attach_colors($post_id,$data['color']);
        $this->_attach_gender($post_id,$data['gn']);
      

      echo  $data['cnd'];

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
                    'value'=> $data['gd'],
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

    public function validate() {
        $msg = '';
       // validate category
       // validate isset
       if(intval($data['ct'])) {
          $product["category_id"] =  $data['ct'];
       }else {
           $msg = "<br> Error in Catageory";
       }
       if(intval($data['bd'])) {
           $product["brand_id"] =  $data['bd'];
       } else {
           $msg .= "<br> Error in Brand";
       }
       if(intval($data['mt'])) {
           $product["material_id"] =  $data['mt'];
       } else {
           $msg .= "<br> Error in Material";
       }
       if(intval($data['color'])) {
           $product["color"] =  $data['color'];
       } else {
           $msg .= "<br> Error in Colors";
       }
       if(intval($data['cnd'])) {
           $product["condition_id"] =  $data['cnd'];
       } else {
           $msg .= "<br> Error in Condition";
       }
       if(in_array($data['gd'],['male','female'])) {
           $product["gender"] =  $data['gender'];
       }

       // validate attachments
       if(isset($data['attachments'])) {
            foreach($data['attachments'] as $file) {
                if( ! $this->_extention_allowed($file)) {
                    $msg .= "<br> Attached photo not allowed file:". basename( $file );
                }
            }
        }else {
            $msg .= "<br> Upload Required photo ";
        }

      if ($msg !=='') {
           return $msg;
      }
      return true;

    }

    private function _attach_category($post_id,$category_id) {

        echo $category_id;
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$category_id),array( '%d', '%d'));
    }

    private function _attach_brand($post_id,$brand_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$brand_id),array( '%d', '%d'));
    }
    private function _attach_condition($post_id,$cnd_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$cnd_id),array( '%d', '%d'));
    }
    private function _attach_materials($post_id,$mt_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$mt_id),array( '%d', '%d'));
    }
    private function _attach_colors($post_id,$color_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$color_id),array( '%d', '%d'));
    }

    private function _attach_gender($post_id,$gender_id) {
        global $wpdb;
        $wpdb->insert( "wp_term_relationships", array("object_id"=>$post_id,"term_taxonomy_id"=>$gender_id),array( '%d', '%d'));
    }


}