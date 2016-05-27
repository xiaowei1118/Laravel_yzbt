<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 2016-05-27
 * Time: 17:17
 */

namespace App\Services;


use App\Banner;

class BannerService
{

    public static function checkBannerCount(){
        $count=Banner::count();

        if($count>6){
            return false;
        }else{
            return true;
        }
    }
}