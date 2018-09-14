<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];
    
    // protected $with=['products'];
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    /**
     * Parse the tags string into and array of string in studly case
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
