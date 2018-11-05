<?php

namespace Inc;

class DataService {


    function retrieveData() {


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

        //return $chain_categories;
        if($is_json) return json_encode($chain_categories);
             return $chain_categories;
       // return implode(',',$chain_categories);
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
        foreach ($materials as $val) {

            array_push($materials,$val);
        }
        if($is_json) return json_encode($materials);
                     return $materials;
    }

}