<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ---------------------- Relationships ----------------------

    /**
     * Return the shop associated with this user
     * @return \App\Shop
     */
    public function shop(){
        return $this->hasOne(Shop::class);
    }

    /**
     * Return this user shopping cart
     * @return \App\ShoppingCart
     */
    public function shoppingCart(){
        return $this->hasOne(ShoppingCart::class);
    }

    /**
     * Return this user checkout info
     * @return \App\checkout
     */
    public function checkout(){
        return $this->hasOne(Checkout::class);
    }

    // ---------------------- End Relationships ----------------------

    /**
     * Verifies if the user has a shopping cart
     * @return bool
     */
    public function hasShoppingCart() : bool{ return ! is_null( $this->shoppingCart );  }

    /**
     * Verifies if the shop belongs to this user
     * @param int $id
     * @return bool
     */
    public function ownsShop($id) : bool{
        return ($this->hasShop() and $this->getShopId() === $id );
    }

    /**
     * Get the Shop's Id associated with this User
     * @return mixed
     */
    public function getShopId() {
        if( $this->hasShop() )
            return $this->shop->id;
        else return null;
    }

    /**
     * Verifies if the user has a shop
     * @return bool
     */
    public function hasShop() : bool { return ! is_null( $this->shop ); }

    /**
     * Verifies if the user has a checkout info
     * @return bool
     */
    public function hasCheckout() : bool { return ! is_null( $this->checkout ); }

    /**
     * Check if the given product id belongs to this cart
     * 
     * @param int $id
     * @return bool
     */
    public function shoppingCartHasProduct($id) : bool{
        return $this->hasShoppingCart() ?  $this->shoppingCart->products->contains($id) : false;
    }
    
    /**
     * Check if the cart is empty
     * 
     * @return bool
     */
    public function isShoppingCartEmpty() : bool{
        return $this->hasShoppingCart() ?  $this->shoppingCart->products->isEmpty() : false;
    }
}
