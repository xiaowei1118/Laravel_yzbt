<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey='city_id';
    public $timestamps=false;
    protected $table='tb_city';
    protected $fillable=['province','city','status'];
}
