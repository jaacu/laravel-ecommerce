<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // protected $with=['products'];

    /**
     * Get the products in this category
     * @return \App\Product
     */
    public function products(){
        return $this->hasMany(Product::class);
    }
}
