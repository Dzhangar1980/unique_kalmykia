<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
			$table->increments('id', 11);
			$table->string('slug', 255);
			$table->integer('category_id');
			$table->integer('status');
			$table->string('title', 255);
			$table->text('content');
			$table->timestamps();		
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
