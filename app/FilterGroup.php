<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $table = 'filter_group';
    protected $fillable = ['name','filter_class_id','created_at','updated_at'];
    protected $primaryKey = 'id';

    public function filterId()
    {
        return $this->hasMany('larashop\Filters', 'filter_group_id');
    }

    public function description(){
        return $this->hasOne('larashop\FilterGroupDescription','filter_group_id')->where('language_id','=',currentLanguageId());
    }

    public function description_ru(){
        return $this->hasOne('larashop\FilterGroupDescription','filter_group_id')->where('language_id','=',1);
    }
}
