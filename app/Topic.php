<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $primaryKey='id';
    public $timestamps=false;
    protected $table='tb_special_topic';
    protected $fillable=['publisher_username','image_url','content','title','create_time',
        'view_count','is_hot','status','is_banner','is_vote'
    ];
}
