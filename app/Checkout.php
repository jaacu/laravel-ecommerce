<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $guarded=[];

    /**
     * A global delimiter to parse and format strings
     * 
     * @var string
     */
    protected static $delimiter=' ,~  '; 
    
    /**
     * Get the user owning this checkout info
     * @return \App\User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /**
     * Parse the address separate strings into a single formatted string
     * 
     * @param string|null $country
     * @param string|null $state
     * @param string|null $street
     * @param string|null $extra
     * @return string 
     */
    public function parseAddress( $country , $state , $street , $extra) : string  {
        //Verifies if any parameter is null, take the billing address as the shipping address
        if( is_null($country) or is_null($state) or is_null($street)   ){
            return $this->billing_address;
        }

        $address = $country . static::$delimiter . $state . static::$delimiter . $street;
        
        if( ! is_null( $extra) ){
            $address .= static::$delimiter . $extra;
        }

        return $address;
    }

    /**
     * Parse the string formatted with parseAddress into an array
     * 
     * @param string $address
     * @return array
     */
    public static function getAddressArray( string $address ) : array {
        return explode( static::$delimiter , $address , 4);
    }

    /**
     * Get only the country from the billing address
     * @return string 
     */
    public function billingCountry(){
        return explode( static::$delimiter  , $this->billing_address , 4 )[0];
    }

    /**
     * Get only the state from the billing address
     * @return string 
     */
    public function billingState(){
        $arr = explode( static::$delimiter  , $this->billing_address , 4 );
        if( count($arr) >= 2 ) return $arr[1];
        else return ''; 
    }

    /**
     * Get only the street from the billing address
     * @return string 
     */
    public function billingStreet(){
        $arr = explode( static::$delimiter  , $this->billing_address , 4 );
        if( count($arr) >= 3) return $arr[2];
        else return ''; 
    }

    /**
     * Get only the extra from the billing address
     * @return string 
     */
    public function extraBilling(){
        $arr = explode( static::$delimiter  , $this->billing_address , 4 );
        if( count( $arr ) == 4   ) return $arr[3];
        return '';
    }

    /**
     * Get only the country from the shipping address
     * @return string 
     */
    public function shippingCountry(){
        return explode( static::$delimiter  , $this->shipping_address , 4 )[0];
    }

    /**
     * Get only the state from the shipping address
     * @return string 
     */
    public function shippingState(){
        $arr = explode( static::$delimiter  , $this->shipping_address , 4 );
        if( count($arr) >= 2 ) return $arr[1];
        else return ''; 
    }

    /**
     * Get only the street from the shipping address
     * @return string 
     */
    public function shippingStreet(){
        $arr = explode( static::$delimiter  , $this->shipping_address , 4 );
        if( count($arr) >= 3 ) return $arr[2];
        else return ''; 
    }

    /**
     * Get only the extra from the shipping address
     * @return string 
     */
    public function extraShipping(){
        $arr = explode( static::$delimiter  , $this->shipping_address , 4 );
        if( count( $arr ) == 4   ) return $arr[3];
        return '';
    }

}
