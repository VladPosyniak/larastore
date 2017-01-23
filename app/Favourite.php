<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourite';
    protected $fillable = ['user_id','product_id','created_at','updated_at'];



}
