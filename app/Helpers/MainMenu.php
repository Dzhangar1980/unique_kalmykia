<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Route;
use Response;
use App\Category;

class MainMenu
{
    public static function getMainCategories(){
        $Categories = Category::orderBy('name', 'asc')->get();
        foreach ($Categories as $Category){
			if($Category->parent == 0){
				$MainCategories[$Category->id] = $Category->name;
				}
			}
		return	$MainCategories;
    }

	public static function getSubCategories($id){
		if($id){
			$SubCategories = Category::where('parent', $id)
						->orderBy('name', 'asc')
						->get();
			return $SubCategories;
		}else{
			return NULL;
		}
	}
}
