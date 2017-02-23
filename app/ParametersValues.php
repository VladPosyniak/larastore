<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ParametersValues extends Model
{
    protected $table = 'parameters_values';
    protected $fillable=['items_id','parameters_id','value'];


    public function all_descriptions(){
        return $this->hasMany('larashop\ParametersDescription','parameter_id','parameters_id');
    }
}
