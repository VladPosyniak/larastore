<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;
use App;

class Products extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'title', 'keywords', 'description', 'description_full', 'values', 'cover', 'price', 'price_old', 'label', 'isset', 'urlhash', 'categories_id','class_id','quantity'];
    protected $guarded = array('id');




    public function description(){
        return $this->hasOne('larashop\ProductDescription','product_id')->where('language_id','=',currentLanguageId());
    }

    public function description_ru(){
        return $this->hasOne('larashop\ProductDescription','product_id')->where('language_id','=',1);
    }

    public function images(){
        return $this->hasMany('larashop\ProductImage','product_id');
    }

    public function recommendProd()
    {
        return $this->hasMany('larashop\recommendsProducts', 'product_id');
    }


    public function recommendProds() // those who follow me
    {
        //$this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
        return $this->belongsToMany('larashop\recommendsProducts', 'recommendsProducts', 'product_id', 'product_id_recommend');
    }

    public function productFilters() // those who follow me
    {
        //$this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
        return $this->hasMany('larashop\ProductFilter','product_id');
    }

    public function productParameters(){
        return $this->hasMany('larashop\ParametersValues','items_id');
    }


    public function productOptions() // those who follow me
    {
        //$this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
        return $this->belongsToMany('larashop\Options', 'product_options', 'product_id', 'option_id');
    }


    public function category()
    {
        return $this->hasOne('larashop\Categories', 'id', 'categories_id');
    }


    public function comments()
    {
        return $this->hasMany('larashop\Comments', 'product_id');
    }


}
