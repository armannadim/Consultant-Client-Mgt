<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('mail', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('sender')->unsigned();
            $t->integer('receiver')->unsigned();
            $t->string('message', 5000)->nullable();
            $t->integer('read_status')->nullable(); //mark as read (1) or mark as unread(0)            
            $t->integer('replied')->nullable(); //no action(0), replied (1)
            $t->integer('deleted')->nullable(); //no action(0), deleted (1)
            $t->string('viewable_to', 100)->nullable(); //who can see this message. comma separeted user id or if selected to all.
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('mail');
    }

}
