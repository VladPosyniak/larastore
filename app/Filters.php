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

    public function description(){
        return $this->hasOne('larashop\FilterDescription','filter_id')->where('language_id','=',currentLanguageId());
    }

    public function description_ru(){
        return $this->hasOne('larashop\FilterDescription','filter_id')->where('language_id','=',1);
    }
}
