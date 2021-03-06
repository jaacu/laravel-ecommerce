<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];
    
    // protected $with=['products'];
    
    /**
     * Get the products with this tag
     * @return \App\Product
     */
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    
    /**
     * Parse the tags string into and array of string in studly case
     * And create them if the don't exists yet
     * @param string $tags
     * @return array
     */
    public static function parseTags( string $tags ){
        $tags = explode(',' , $tags);
        $tags = array_map(function($item){
            $item = studly_case($item);
            $tag = Tag::whereName($item)->first();
            if( is_null($tag) ){
                $tag = Tag::create(['name' => $item]);
            } 
            return $tag->id;
            } , $tags);
        return $tags;
    }
}
