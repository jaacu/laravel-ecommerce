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

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

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
}
