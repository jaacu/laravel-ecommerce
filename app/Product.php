<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\ModelHelper;

class Product extends Model
{

    use SoftDeletes, ModelHelper;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['shop'];
    
    // protected $with = ['tags' , 'categories'];

    protected $guarded = [];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function getUser(){
        return $this->shop->user;
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function getShopId(){
        return $this->shop->id;
    }

    public function getShopName(){
        return $this->shop->name;
    }
}
