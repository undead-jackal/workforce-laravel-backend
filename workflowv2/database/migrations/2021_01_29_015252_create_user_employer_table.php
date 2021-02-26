<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmployerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_employer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential');
            $table->string('fname');
            $table->string('lname');
            $table->longtext('contact');
            $table->longtext('emails');
            $table->string('company');
            $table->string('company_address');
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
        Schema::dropIfExists('user_employer');
    }
}
