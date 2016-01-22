<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients', function(Blueprint $t) {
            $t->increments('id');            
            $t->string('name', 100)->nullable();
            $t->string('full_name', 200)->nullable();
            $t->integer('doc_type')->unsigned(); 
            $t->string('identity', 20)->nullable();
            $t->string('address', 500)->nullable();
            $t->string('country', 100)->nullable();
            $t->string('contact_number', 100)->nullable();
            $t->string('email', 100)->nullable();
            $t->softDeletes()->nullable();
            $t->integer('addedby_user_id')->unsigned();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('clients');
    }

}
