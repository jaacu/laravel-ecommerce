<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\ModelHelper;

class Shop extends Model
{
    use SoftDeletes, ModelHelper;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    /**
     * Return the products of this shop
     * @return \App\Product
     */
    public function products(){
        return $this->hasMany(Product::class);
    }

    /**
     * Return the owner of this shop
     * @return \App\User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get this shop tags
     * @return \App\Tag
     */
    public function getTags(){
        return $this->products()->with('tags')->get()->flatMap(function( $product ){
            return $product->tags;
        })->unique('id');
    }

    /**
     * Get this shop categories
     * @return \App\Category
     */
    public function getCategories(){
        return $this->products()->with('categories')->get()->flatMap(function( $product ){
            return $product->categories;
        })->unique('id');
    }

    /**
     * Get this shop's owner id 
     * @return int
     */
    public function getUserId(){
        return $this->user->id;
    }

    /**
     * Get the total stock of products in the shop
     * @return int
     */
    public function getTotalStock() : int{
        return $this->products->sum->stock;
    }

    /**
     * Get the total of products int the shop
     * @return int
     */
    public function getTotalProducts() : int{
        return $this->products->count();
    }

    /**
     * Get the cheapest product
     * @return int
     */
    public function getCheap(){
        return $this->products->min->price;
    }

    /**
     * Get the most expensive product
     * @return int
     */
    public function getExpensive(){
        return $this->products->max->price;
    }
}
