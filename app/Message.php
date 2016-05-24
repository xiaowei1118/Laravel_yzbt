<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='tb_message';
    protected $fillable=['content','title','link','category'];
    protected $primaryKey="message_id";
}
