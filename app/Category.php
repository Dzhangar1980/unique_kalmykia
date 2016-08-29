<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    
    public function children()
    {
        return $this->hasMany('App\Category', 'parent', 'id'); 
    }

	public function mather()
    {
        return $this->hasOne('App\Category', 'id', 'parent'); 
    }

	public static function relatedCategories($id)
    {
        return self::with(['children', 'parent'])->find($id);
    }

}
