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

    public function shop(){
        return $this->hasOne(Shop::class);
    }
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
}
