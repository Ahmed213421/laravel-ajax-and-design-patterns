<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePostTagTable extends Migration {

	public function up()
	{
		Schema::create('post_tag', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('tag_id')->unsigned();
			$table->bigInteger('post_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('post_tag');
	}
}