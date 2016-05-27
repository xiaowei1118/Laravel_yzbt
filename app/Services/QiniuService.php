<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 2016-05-22
 * Time: 23:23
 */
namespace App\Services;

use zgldh\QiniuStorage\QiniuStorage;
use Config;

class QiniuService
{
    private $disk;
    private $butcket;
    private $domain;
    public function __construct()
    {
        $this->disk=QiniuStorage::disk('qiniu');
        $this->butcket="yzbt-bucket";
        $this->domain="http://o7fnmn25g.bkt.clouddn.com/";
    }

    public function storage($contents){
        $disk = QiniuStorage::disk('qiniu');
        $disk->put('test.jpg',$contents);
    }

    public function getToken(){
        $key=$this->butcket;
        return $this->disk->uploadToken($key);
    }

    public function getDomain(){
        return $this->domain;
    }
}