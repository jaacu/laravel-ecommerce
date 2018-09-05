<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    
    protected $guarded = [];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function getUser(){
        return $this->shop->user;
    }
}
