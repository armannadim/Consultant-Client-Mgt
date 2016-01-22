<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('visitDetails', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('visits_id')->unsigned();                          
            $t->string('problem', 1000)->nullable();
            $t->string('comments', 5000)->nullable();            
            $t->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('visitDetails');
    }

}
