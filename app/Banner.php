<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps=false;
    protected $fillable=['type','type_id'];
    protected $table='tb_banner';
}
