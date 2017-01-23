<?php

namespace larashop;

use Illuminate\Database\Eloquent\Model;

class FilterGroupDescription extends Model
{
    protected $table = 'filter_group_description';

    protected $fillable = ['name','filter_group_id','language_id'];

}
