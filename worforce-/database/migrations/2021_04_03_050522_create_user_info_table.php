<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('credential');
            $table->string('bday');
            $table->longtext('contacts');
            $table->longtext('emails');
            $table->longtext('languages');
            //freelancer&coordinator
            $table->string('sss');
            $table->string('philhealth');
            $table->string('pagibibg');
            $table->string('tin');
            //freelancer
            $table->longtext('work');
            $table->longtext('education');
            $table->longtext('employement');
            $table->longtext('skills');
            $table->longtext('description');
            $table->longtext('level');
            //employer
            $table->string('company');
            $table->string('company_address');
            $table->string('company_email');
            $table->longtext('company_contact');
            $table->integer('is_Deleted');

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
        Schema::dropIfExists('user_info');
    }
}
