<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable=['type','publisher_username',
        'title','image_url','city_id','create_time','address','registration_time','registration_deadline','view_count',
        'status','is_hot','is_banner','telephone','is_apply','detail_content','number'
    ];
    public $timestamps=false;
    protected $table='tb_public_notice';
    protected $primaryKey='id';
}
