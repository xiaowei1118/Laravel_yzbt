<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    protected $table="tb_public_notice_apply";
    protected $fillable=['public_notice_id','open_id','baby_id','status','remark','create_time'];
    protected $primaryKey='id';
}
