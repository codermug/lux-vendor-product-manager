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
        add_action( 'wp_ajax_lux_form_cat_materials',        [$this,'postCategoryMaterials']);
        add_action( 'wp_ajax_nopriv_lux_form_cat_materials', [$this,'getJsonMaterials'] );

        add_action( 'wp_ajax_lux_form_del_cat_materials',    [$this,'deleteCategoryMaterial'] );
        add_action( 'wp_ajax_nopriv_lux_form_del_cat_materials',    [$this,'deleteCategoryMaterial'] );
        

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
        $category  = CategoryModel::find($id);
        $records   = CategoryModel::getMaterialsRecords($id);

        $nds_admin_nonce = wp_create_nonce( 'nds_admin_nonce' );
        _includes('admin/category/show.php',[
            "category"=>$category,
            "records"=>$records,
            "nonce" => $this->getNonce(),
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

    private function getNonce() {
        return wp_create_nonce( 'nds_admin_nonce' );
    }

    public function postCategoryMaterials() {


        //echo "<pre>"; print_r($_POST);
        if( isset( $_POST['nds_admin_nonce'] ) && wp_verify_nonce( $_POST['nds_admin_nonce'], 'nds_admin_nonce') ) {
            // validate $_post
            // insert post
            CategoryModel::insert($_POST);
            $status = "success";
            $alert  = "success";
            $msg    = " Added successfully";

        }
        else {
            $status = "error";
            $alert  = "danger";
            $msg    = " unable to save ";
        
        }

        echo json_encode(['msg'=>$msg,'alert'=>$alert,'status'=>$status]);
        exit();
    }

    public function deleteCategoryMaterial() {


       if( CategoryModel::delete(intval($_POST['delid']))) {

        echo json_encode(['msg'=>'Material Removed Successfully','alert'=>'success','status'=>$status]);
        exit();
       }

       echo json_encode(['msg'=>'Unable to remove material','alert'=>'danger','status'=>'error']);
       exit();
    }


}