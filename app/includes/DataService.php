<?php

namespace App\Inc;
use App\Models\CategoryModel;

class DataService {


    function retrieveData() {


    }


    static function wooCommerceProductsPrice($product_status=''){

        $sql = "SELECT  ";
        $sql .= " SUM(pt.meta_value)  AS price";

        $sql .= " FROM wp_posts p ";
        $sql .= " INNER JOIN wp_postmeta m ON ( p.id = m.post_id)";
        $sql .= " INNER JOIN wp_postmeta mt ON (p.id = mt.post_id)";
        $sql .= " INNER JOIN wp_postmeta pt ON (p.id = pt.post_id)";
        $sql .= " INNER JOIN wp_postmeta wt ON (p.id = wt.post_id )";
        $sql .= " WHERE p.post_type = 'product' ";
        $sql .= " AND m.meta_key = '_stock_status' ";
        $sql .= " AND mt.meta_key = '_sku' ";
        $sql .= " AND pt.meta_key = '_price' ";
        $sql .= " AND wt.meta_key = '_weight'";


        if(!empty($product_status)) {
            $sql .= " And m.meta_value like '" . $product_status . "'";
        }


        global $wpdb;
        $results = $wpdb->get_results($sql);


        //echo "<pre>"; print_r($results);
        return $results;

    }
    static function wooCommerceProducts($is_json=0){
         $sql    = "SELECT  p.id,";
        // $sql  .= " table_sku.meta_value AS sku,";
         $sql .= " table_stock.meta_value AS stock,  ";
         $sql .= " p.post_title AS title,";
         $sql .= " p.post_status AS status,";
         $sql .= " p.post_date AS date,";
          $sql .= " p.post_content AS description,";
         $sql  .= " pt.meta_value AS price";
         // $sql .= " wt.meta_value AS weight ";

        $sql .= " FROM wp_posts p ";
        $sql .= " INNER JOIN wp_postmeta table_stock ON ( p.id = table_stock.post_id)";
        //$sql .= " INNER JOIN wp_postmeta table_sku ON (p.id = table_sku.post_id)";
        $sql .= " INNER JOIN wp_postmeta pt ON (p.id = pt.post_id)";
       // $sql .= " INNER JOIN wp_postmeta wt ON (p.id = wt.post_id )";

        $sql .= " WHERE p.post_type = 'product' ";
        $sql .= " AND table_stock.meta_key = '_stock_status' ";
      //  $sql .= " AND table_sku.meta_key = '_sku' ";
        $sql .= " AND pt.meta_key = '_price' ";
      //  $sql .= " AND wt.meta_key = '_weight'";

         global $wpdb;
         $results = $wpdb->get_results($sql);


        //echo "<pre>"; print_r($results);
         return $results;

    }
    static function wooCommerceCategories($only_root=0,$is_json=0){
        $chain_categories = [];
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 1;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );

        foreach ($all_categories as $cat) {
            //if(  $cat->category_parent == 0) {
                $category_id = $cat->term_id;


                $temp_arr = ['id'=>$cat->term_id,'text'=> $cat->name,'children'=>[],'total_products'=> $cat->count];
                $args2 = array(
                    'taxonomy'     => $taxonomy,
                    'child_of'     => 0,
                    'parent'       => $category_id,
                    'orderby'      => $orderby,
                    'show_count'   => 1,
                    'pad_counts'   => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li'     => $title,
                    'hide_empty'   => $empty
                );
                $sub_cats = get_categories( $args2 );

                if($sub_cats) {

                    foreach($sub_cats as $sub_category) {
                    //    echo  '-----'.$sub_category->name ;
                        array_push($temp_arr['children'],['id'=>$sub_category->term_id,'text'=>$sub_category->name,'total_products'=> $sub_category->count]);
                        //$chain_categories[$cat->term_id]['children'] = ['id'=>$sub_category->id,'text'=>$sub_category->name];
                    }
                }else{
                    unset($temp_arr['children']);
                }

                array_push($chain_categories,$temp_arr);
           // }
        }

        //echo '<pre>';print_r(json_encode($chain_categories));

        if($is_json) return json_encode($chain_categories);
             return $chain_categories;


    }

    public static function categoryMaterialsAssociated() {
        $chain_categories = [];
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 1;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $categories = get_categories( $args );
        $data = [];
        foreach ($categories as $key => $value) {
          //  $data['category_id']['category_id'] = $value->term_id;
            $data[$value->term_id]['materials']   = CategoryModel::getMaterials($value->term_id);
           
        }

        return json_encode($data);
    }

    static function wooCommerceCondition($is_json=0){
        $data = [];
        $fields = self::getTaxanomy('pa_condition');
        foreach ($fields as $val) {
            $temp_arr = ['id'=>$val->term_id,'text'=> $val->name,'description'=>$val->description];
            array_push($data,$temp_arr);
        }
        if($is_json)
            return json_encode($data);
        return $data;
    }

    static function wooCommerceGender($is_json=0){
        $data = [];
        $fields = self::getTaxanomy('pa_gender');
        foreach ($fields as $val) {
            $temp_arr = ['id'=>$val->term_id,'text'=> $val->name,'description'=>$val->description];
            array_push($data,$temp_arr);
        }
        if($is_json)
            return json_encode($data);
        return $data;
    }

    static function wooCommerceColor($is_json=0){
        $data = [];
        $fields = self::getTaxanomy('pa_colour');
        foreach ($fields as $val) {
            $temp_arr = ['id'=>$val->term_id,'text'=> $val->name,'description'=>$val->description];
            array_push($data,$temp_arr);
        }
        if($is_json)
            return json_encode($data);
        return $data;
    }


    static function wooCommerceBrands($is_json=0){
        $data = [];
        $args = [
            'taxonomy'     => 'brand',
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        ];
        $brands = get_terms( $args );
        foreach ($brands as $val) {
            $temp_arr = ['id'=>$val->term_id,'text'=> $val->name];
            array_push($data,$temp_arr);
        }
        if($is_json) return json_encode($data);
        return $data;
    }


    static function wooCommerceMaterials($is_json=0){
        $materials = [];
        $args = [
            'taxonomy'     => 'pa_materials',
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        ];
        $materials = get_terms( $args );
       // _printr($materials);
        foreach ($materials as $val) {

            array_push($materials,$val);
        }
        if($is_json) return json_encode($materials);
                     return $materials;
    }

    private function getTaxanomy($taxanomy) {
        $args = [
            'taxonomy'     => $taxanomy,
            'orderby'      => 'name',
            'show_count'   => 0,
            'pad_counts'   => 0,
            'hierarchical' => 1,
            'title_li'     => '',
            'hide_empty'   => 0
        ];
        return get_terms( $args );
    }

}