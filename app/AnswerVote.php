<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    protected $fillable=['item_id','open_id'];
    protected $table='tb_st_item_vote';
    public $timestamps=false;
}
