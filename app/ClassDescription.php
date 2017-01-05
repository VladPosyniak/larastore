<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class ClassDescription extends Model
{
    protected $table = 'class_description';
    protected  $fillable = ['name','description','keywords','class_id','title'];
}
