<?php
/**
 * Created by PhpStorm.
 * User: Soso
 * Date: 11/6/2018
 * Time: 9:26 AM
 */

namespace App\Inc;


class Activate
{
    public static function activate (){
        flush_rewrite_rules();
    }

}