<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHobbiesTable extends Migration {

	public function up()
	{
		Schema::create('hobbies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('hobbies');
	}
}
