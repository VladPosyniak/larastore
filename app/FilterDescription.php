<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class FilterDescription extends Model
{
    protected $table = 'filter_description';

    protected $fillable = ['language_id','value','filter_id'];
}
