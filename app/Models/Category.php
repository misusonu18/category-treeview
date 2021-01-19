<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title','parent_id'];

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id') ;
    }
}
