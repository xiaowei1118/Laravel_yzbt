<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    public $timestamps=false;
    protected $table='tb_baby';
    protected $fillable=['photo_url','nickname','name','sex','birthdate','height','weight','living_city',
        'talent','moka_image_urls',
    ];
}
