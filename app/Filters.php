<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{
    protected $table = 'filter';

    protected $fillable =['filter_group_id','value'];

    public function products(){
        return $this->belongsToMany('larashop\Products','product_filter','filter_id','product_id');
    }
}
