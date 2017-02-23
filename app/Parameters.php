<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    protected $table = 'parameters';
    protected $fillable=['title','unit'];

    public function description(){
        return $this->hasOne('larashop\ParametersDescription','parameter_id')->where('language_id','=',currentLanguageId());
    }
    public function description_ru(){
        return $this->hasOne('larashop\ParametersDescription','parameter_id')->where('language_id','=',1);
    }

    public function all_descriptions(){
        return $this->hasMany('larashop\ParametersDescription','parameter_id');
    }

    public function all_values(){
        return $this->hasMany('larashop\ParametersValues','parameter_id');
    }

}
