<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Page;

class PagesTableSeeder extends Seeder {

	public function run()
	{
			DB::table('pages')->insert([			
			'slug' => 'test', 
			'status' => 'published', 
			'title' => 'The Name', 
			'content' => 'text text text' 
			]);		
	}
}
