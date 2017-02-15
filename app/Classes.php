<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;
use larashop\Language;

class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['id','name','description','cover','urlhash','title','keywords'];

    public function description(){
        return $this->hasOne('larashop\ClassDescription','class_id')->where('language_id','=',currentLanguageId());
    }

    public function all_descriptions(){
        return $this->hasMany('larashop\ClassDescription','class_id');
    }

    public function description_ru(){
        return $this->hasOne('larashop\ClassDescription','class_id')->where('language_id','=',1);
    }


}
