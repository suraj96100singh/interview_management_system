<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTotalQuestionAndTotalCorrectQuestionAndCandidateStatusToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->string('total_question',255)->nullable();
            $table->string('total_correct_question',255)->nullable();
            $table->string('candidate_interview_status',255)->nullable();
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
            $table->string('total_question',255)->nullable();
            $table->string('total_correct_question',255)->nullable();
            $table->string('candidate_interview_status',255)->nullable();
        });
    }
}
