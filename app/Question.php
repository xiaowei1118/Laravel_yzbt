<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table="tb_st_question";
    public $timestamps=false;
    protected $fillable=['st_id','question'];
}
