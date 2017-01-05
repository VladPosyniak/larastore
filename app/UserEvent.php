<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $table = 'user_event';
    protected $fillable = ['id','date','name','created_at','updated_at'];
}
