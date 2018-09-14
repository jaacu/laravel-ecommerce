<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // protected $with=['products'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
