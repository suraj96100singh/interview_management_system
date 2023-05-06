<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewCandidateWorkExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_candidate_work_experience', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('interviews');
            $table->string('candidate_company_name')->nullable();
            $table->string('candidate_work_experience')->nullable();
            $table->string('candidate_salary_per_month')->nullable();
            $table->enum('cheque_cash_status',['cheque','cash'])->nullable();
            $table->enum('full_part_time_status',['full-time','part-time'])->nullable();
            $table->string('reason_for_leaving_previous_company');
            $table->softDeletes();
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
        Schema::dropIfExists('interview_candidate_work_experience');
    }
}
