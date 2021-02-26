<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUserFreelancer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_freelancer', function (Blueprint $table) {
            $table->longtext('description');
            $table->longtext('employement');
            $table->string('sss');
            $table->string('tin');
            $table->string('pagibig');
            $table->string('philhealth');
            $table->string('address');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_freelancer', function (Blueprint $table) {
            //
        });
    }
}
