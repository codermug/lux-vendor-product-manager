<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 11:03 AM
 */

namespace App;


use App\Controllers\AdminController;
use App\Controllers\FrontController;
use App\Inc\AdminSetting;
use App\Inc\FrontSetting;

class Start {

    private $classes = [
        AdminSetting::class,
        AdminController::class,
        FrontSetting::class,
        FrontController::class
    ];

    /// load all plugin related classes
    // the register method inside classes is for setting the default actions
    public function loadClasses() {
        foreach ($this->classes as $class) {
            $service = $this->instantiate( $class );
            if(method_exists($service, "register")) {
                $service->register();
            }
        }
    }

    private function instantiate($class) {
        return new $class();
    }
    // trigger methods
    public function register() {

        $this->loadClasses();

    }

    function activate() {
        
    }
    function deactivate() {

    }
    //  function uninstall() {}

}