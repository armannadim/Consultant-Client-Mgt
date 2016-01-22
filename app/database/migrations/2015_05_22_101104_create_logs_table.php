<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('logs', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('user_id')->unsigned();
            $t->string('activity', 500);
            $t->string('module', 100);            
            $t->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('logs');
    }

}
