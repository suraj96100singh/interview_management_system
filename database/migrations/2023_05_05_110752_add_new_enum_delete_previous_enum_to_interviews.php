<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewEnumDeletePreviousEnumToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn('candidate_marriage_status');
            $table->dropColumn('candidate_have_DL_status');
            $table->dropColumn('candidate_have_PAN_status');
            // $table->enum('candidate_marriage_status',['Yes','No'])->nullable();
            // $table->enum('candidate_have_DL_status',['Yes','No'])->nullable();
            // $table->enum('candidate_have_PAN_status',['Yes','No'])->nullable();
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
            $table->dropColumn('candidate_marriage_status');
            $table->dropColumn('candidate_have_DL_status');
            $table->dropColumn('candidate_have_PAN_status');
            // $table->enum('candidate_marriage_status',['Yes','No'])->nullable();
            // $table->enum('candidate_have_DL_status',['Yes','No'])->nullable();
            // $table->enum('candidate_have_PAN_status',['Yes','No'])->nullable();
        });
    }
}
