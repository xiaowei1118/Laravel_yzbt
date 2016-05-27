<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyVote extends Model
{
    protected $fillable=['apply_id','pn_id','openid'];
    public $timestamps=false;
    protected $table="tb_pn_apply_vote";
}
