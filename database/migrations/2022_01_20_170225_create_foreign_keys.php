<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('customers', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('customers_hobbies', function(Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('customers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('customers_hobbies', function(Blueprint $table) {
			$table->foreign('hobbie_id')->references('id')->on('hobbies')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('customers', function(Blueprint $table) {
			$table->dropForeign('customers_user_id_foreign');
		});
		Schema::table('customers_hobbies', function(Blueprint $table) {
			$table->dropForeign('customers_hobbies_customer_id_foreign');
		});
		Schema::table('customers_hobbies', function(Blueprint $table) {
			$table->dropForeign('customers_hobbies_hobbie_id_foreign');
		});
	}
}
