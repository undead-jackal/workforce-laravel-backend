<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUserCoordinatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_coordinator', function (Blueprint $table) {
            $table->string('address');
            $table->string('bday');

            $table->string('sss');
            $table->string('pagibig');
            $table->string('philhealth');
            $table->string('tin');

            $table->longtext('contacts');
            $table->longtext('education');
            $table->longtext('emails');
            $table->longtext('langauge');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_coordinator', function (Blueprint $table) {
            //
        });
    }
}
