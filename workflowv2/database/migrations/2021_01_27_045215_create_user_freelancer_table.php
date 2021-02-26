<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFreelancerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_freelancer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential');
            $table->string('fname');
            $table->string('lname');
            $table->string('bday');
            $table->integer('is_deleted');
            $table->integer('level');
            $table->longtext('contacts');
            $table->longtext('emails');
            $table->longtext('work');
            $table->longtext('education');
            $table->longtext('skills');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_freelancer');
    }
}
