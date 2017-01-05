<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class FilterClass extends Model
{
    protected $table = 'filter_class';

    public function getFilterGroups(){
        return $this->hasMany('larashop\FilterGroup','filter_class_id');
    }
}
