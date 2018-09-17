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

    /**
     * Get the user where this shops belongs
     * @return \App\Shop
     */
    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the user owner of product
     * @return \App\User
     */
    public function getUser(){
        return $this->shop->user;
    }

    /**
     * Get the tags associated with this product
     * @return \App\Tag
     */
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the categories associated with this product
     * @return \App\Category
     */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    /**
     * Get this product's shop id
     * @return int
     */
    public function getShopId(){
        return $this->shop->id;
    }

    /**
     * Get this product's shop name
     * @return string
     */
    public function getShopName(){
        return $this->shop->name;
    }
}
