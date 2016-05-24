<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="tb_admin";
    protected $fillable=['username','password','role'];
    protected $primary_key='id';
    public $timestamps=false;
}
