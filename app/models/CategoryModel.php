<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 1:11 PM
 */

namespace App\Models;


class CategoryModel
{
    private static $table = 'wp_lux_category_materials';

    public static function insert($posts) {
        global $wpdb;


        if(isset($posts['materials'])) {
              foreach ($posts['materials'] as $material) {
               $data = array(
                   'category_id'       => $posts['category_id'],
                   'category_taxonomy' => 'product_cat',
                   'material_id'       => $material,
                   'material_taxanomy' =>'pa_materials',
               );
                 $wpdb->insert(self::$table, $data,
                    array( '%d', '%s', '%d', '%s')
                );

            }
        }
    }


    public static function getMaterials($id) {
        global $wpdb;
        return $wpdb->get_results( "SELECT wp_terms.name as name FROM wp_terms WHERE  term_id in (SELECT material_id FROM ".self::$table." WHERE category_id = ".$id.")");

    }

    public static function find($id) {
        global $wpdb;
        $r =  $wpdb->get_results( "SELECT wp_terms.name as name FROM wp_terms WHERE  term_id =".$id);
        if(isset($r[0]))
            return $r[0];
        return null;

    }


}