<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['url','product_id','created_at','updated_at'];

}
