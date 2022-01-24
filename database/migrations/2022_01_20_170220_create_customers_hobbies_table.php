<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersHobbiesTable extends Migration {

	public function up()
	{
		Schema::create('customers_hobbies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('customer_id')->unsigned();
			$table->integer('hobbie_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('customers_hobbies');
	}
}
