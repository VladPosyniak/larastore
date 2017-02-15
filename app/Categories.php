<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'cover', 'urlhash', 'class_id', 'title', 'keywords'];


    public function products()
    {
        return $this->hasMany('larashop\Products', 'categories_id');

    }
    public function all_descriptions(){
        return $this->hasMany('larashop\CategoryDescription','category_id');
    }

    public function description(){
        return $this->hasOne('larashop\CategoryDescription','category_id')->where('language_id','=',currentLanguageId());
    }

    public function description_ru(){
        return $this->hasOne('larashop\CategoryDescription','category_id')->where('language_id','=',1);
    }


}
