<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("start_day");
            $table->integer("end_day");
            $table->string("room_number");
            $table->string("name");
            $table->string("father_name");
            $table->string("phone");
            $table->string("nrc");
            $table->string("gender");
            $table->integer("age");
            $table->string("nation");
            $table->string("job");
            $table->string("address");
            $table->string('state');
            $table->tinyInteger("guest_status");
            $table->tinyInteger("row_record");
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
        Schema::dropIfExists('check_ins');
    }
}
