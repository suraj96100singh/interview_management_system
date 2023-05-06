<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDlMarriagePanStatusColumnToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
             $table->enum('candidate_marriage_status',['Yes','No'])->nullable();
            $table->enum('candidate_have_DL_status',['Yes','No'])->nullable();
            $table->enum('candidate_have_PAN_status',['Yes','No'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interviews', function (Blueprint $table) {
             $table->enum('candidate_marriage_status',['Yes','No'])->nullable();
            $table->enum('candidate_have_DL_status',['Yes','No'])->nullable();
            $table->enum('candidate_have_PAN_status',['Yes','No'])->nullable();
        });
    }
}
