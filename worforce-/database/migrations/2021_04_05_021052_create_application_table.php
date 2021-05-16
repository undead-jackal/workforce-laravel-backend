<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("applicant");
            $table->integer("applicant_type");
            $table->integer("type");
            $table->integer("status");
            $table->integer("job");
            $table->integer("inviter");
            $table->integer("inviter_type");
            $table->longtext("proposal");
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
        Schema::dropIfExists('application');
    }
}
