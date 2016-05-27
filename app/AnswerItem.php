<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerItem extends Model
{
    protected $fillable=['question_id','content'];
    public $timestamps=false;
    protected $table='tb_st_item';
}
