<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $fillable = ['id','name','description','cover','urlhash','title','keywords'];

    public function description(){
        return $this->hasOne('larashop\ClassDescription','class_id')->where('language_id','=',currentLanguageId());
    }

    public function description_ru(){
        return $this->hasOne('larashop\ClassDescription','class_id')->where('language_id','=',1);
    }
}
