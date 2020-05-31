<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedMoveGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_guests', function (Blueprint $table) {
            $table->integer('id');
            $table->integer("start_day");
            $table->integer("end_day");
            $table->string("room_number");
            $table->string("name")->nullable();
            $table->string("father_name")->nullable();
            $table->string("phone");
            $table->string("nrc")->nullable();
            $table->string("gender")->nullable();
            $table->string("age")->nullable();
            $table->string("nation")->nullable();
            $table->string("job")->nullable();
            $table->string("address")->nullable();
            $table->string('state')->nullable();
            $table->tinyInteger("guest_status")->nullable();
            $table->integer("month");
            $table->integer("year");
            $table->tinyInteger("row_record")->default(0);
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
        //
    }
}
