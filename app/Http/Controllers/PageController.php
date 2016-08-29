<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Page;

class PageController extends Controller
{
	public function show($slug)
	{
		//echo $slug;
		$pageRes = Page::where('slug', '=', $slug, 'and', 'status', '=', 'published')->firstOrFail();  
		//var_dump($pageRes);
		//echo $pageRes->title;
		return view('page', ['page' => $pageRes] ); 
	}

 }
