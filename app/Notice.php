<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable=['type','publisher_username',
        'title','image_url','city_id','start_time','address',
        'period','registration_time','registration_deadline','view_count',
        'status','is_hot','is_banner','telephone','is_apply','detail_content'
    ];
    protected $table='tb_public_notice';
    protected $primaryKey='id';
}
