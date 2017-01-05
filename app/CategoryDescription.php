<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    protected $table = 'category_description';
    protected $fillable = ['category_id','language_id','name','description','title','keywords'];



}
