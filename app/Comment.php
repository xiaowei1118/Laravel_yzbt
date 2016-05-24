<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey='id';
    public $timestamps=false;
    protected $table='tb_pn_comment';
    protected $fillable=['parent_id','pn_id','comment','openid','create_time'];
}
