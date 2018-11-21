<?php
namespace App\Controllers;
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 10:44 AM
 */
Use App\Inc\AdminInit;
use App\Inc\DataService;
use App\Models\CategoryModel;

class AdminController
{
    private $nonce;


    public function route()
    {

        $route =  substr($_GET['page'], (strlen(PLUGIN_NAME) - strlen($_GET['page'])+1));


        if(isset($_GET['a']) && isset($_GET['p'])) {
            $method  = $_GET['p'].ucfirst($_GET['a']);

        }else{
            $method = $route . 'Index';
        }

        if(method_exists($this,$method)) {
            $this->$method();
        } else {
            echo "Method doesn't exists";
        }

    }

    public function register() {
       // add_action( 'admin_post_form_cat_materials', [$this, 'postCategoryMaterials']);
        add_action( 'wp_ajax_lux_form_cat_materials', [$this, 'postCategoryMaterials']);
        add_action( 'wp_ajax_nopriv_lux_form_cat_materials', [$this,'getJsonMaterials'] );

    }


    public  function dashboard() {
       $materials =   DataService::wooCommerceMaterials();
       $categories =  DataService::wooCommerceCategories();

        //echo "<pre>"; print_r($materials);

        _includes('admin/dashboard.php',[
            'categories'=>$categories,
            'materials'=>$materials,
        ]);
    }

    public static function categoriesIndex() {
        $materials =   DataService::wooCommerceMaterials();
        $categories =  DataService::wooCommerceCategories();

        //echo "<pre>"; print_r($materials);

        _includes('admin/category/index.php',[
            'categories'=>$categories,
            'materials'=>$materials,
        ]);
    }

    public function categoryShow() {

        $id = $_GET["id"];
        $category = CategoryModel::find($id);
        $materials = CategoryModel::getMaterials($id);

        print_r($category);
        _includes('admin/category/show.php',[
            "category"=>$category,
            "materials"=>$materials
        ]);
    }
    public function productsIndex() {
        $products = DataService::wooCommerceProducts();
        $total_instock  = DataService::wooCommerceProductsPrice('instock');
        $total_outofstock = DataService::wooCommerceProductsPrice('outofstock');
        $total_prices = DataService::wooCommerceProductsPrice();

        //echo "<pre>"; print_r($total_prices);

        _includes('admin/product/index.php',[
            'products'=>$products,
            'total_instock'=>$total_instock[0],
            'total_outofstock'=>$total_outofstock[0],
            'total_prices'=>$total_prices[0],
        ]);
    }

    public function postCategoryMaterials() {


        if( isset( $_POST['nds_add_user_meta_nonce'] ) && wp_verify_nonce( $_POST['nds_add_user_meta_nonce'], 'nds_add_user_meta_form_nonce') ) {
            // sanitize the input
            /*$nds_user_meta_key = sanitize_key( $_POST['nds']['user_meta_key'] );
            $nds_user_meta_value = sanitize_text_field( $_POST['nds']['user_meta_value'] );
            $nds_user =  get_user_by( 'login',  $_POST['nds']['user_select'] );
            $nds_user_id = absint( $nds_user->ID ) ;
            // do the processing
            // add the admin notice
            $admin_notice = "success";
            // redirect the user to the appropriate page
            $this->custom_redirect( $admin_notice, $_POST );
            exit;*/


             CategoryModel::insert($_POST);
            $status = "success";
            $alert  = "success";
            $msg    = " added successfully";

        }
        else {
            $status = "error";
            $alert  = "danger";
            $msg    = " unable to save ";
            /*wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
                'response' 	=> 403,
                'back_link' => 'admin.php?page=' . $this->plugin_name,
            ));*/
        }

        echo json_encode(['msg'=>$msg,'alert'=>$alert,'status'=>$status]);
        exit();
    }


}