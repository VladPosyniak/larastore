<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    protected $fillable = ['name','code','status','image'];
}
