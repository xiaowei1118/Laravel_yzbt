<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicComment extends Model
{
    protected $primaryKey='id';
    public $timestamps=false;
    protected $table='tb_st_comment';
    protected $fillable=['parent_id','st_id','openid','content','create_time'];
}
