<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('visits', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('staff_user_id')->unsigned();
            $t->integer('client_id')->unsigned();            
            $t->timestamp('visit_date_time', 100);            
            
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('visits');
    }

}
