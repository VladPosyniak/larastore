<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    protected $table = 'products_description';
    protected $fillable = ['name','product_id','language_id','title','keywords','description','description_full','description_meta'];

    public function product(){
        return $this->belongsTo('larashop\Products','product_id','id');
    }
}
