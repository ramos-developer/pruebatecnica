<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('surname');
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}
