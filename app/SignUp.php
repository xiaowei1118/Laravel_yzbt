<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    protected $table="tb_pn_apply";
    protected $fillable=['pn_id','open_id','baby_id','remark','create_time','is_vote','feedback'];
    protected $primaryKey='id';
    public $timestamps=false;
}
