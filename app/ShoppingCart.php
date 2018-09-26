<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * Get the products in this shopping cart
     * Use the pivot table as a 'order' attribute and include the timestamps and the amount column
     * @return \App\Product
     */
    public function products(){
        return $this->belongsToMany(Product::class)
                    ->as('order')
                    ->withTimestamps()
                    ->withPivot('amount');
    }

    /**
     * Get the user owning this shopping cart
     * @return \App\User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the total count of products this the shopping cart
     * @return int
     */
    public function totalCount() : int{
        return $this->products->count();
    }

    /**
     * Get the cart sub Total
     * @return float
     */
    public function getSubTotal() : float {

        $total = $this->products->reduce(function ($carry, $product) {
            return $carry + ($product->order->amount * $product->price);
        });
        return $total ?? 0;
    }

    /**
     * Get the cart Total
     * @return float
     */
    public function getTotal() : float {
        return $this->getSubTotal();
    }

}
