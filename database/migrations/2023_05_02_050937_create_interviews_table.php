<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('candidate_name')->nullable();
            $table->date('candidate_dob')->nullable();
            $table->string('candidate_age')->nullable();
            $table->string('candidate_number')->nullable();
            $table->string('candidate_email')->nullable();
            $table->enum('candidate_marriage_status',['Yes,No'])->nullable();
            $table->longText('candidate_permanent_address')->nullable();
            $table->longText('candidate_current_address')->nullable();
            $table->string('candidate_10th_marks')->nullable();
            $table->string('candidate_10th_institution_name')->nullable();
            $table->string('candidate_10th_medium')->nullable();
            $table->string('candidate_12th_subject_name')->nullable();
            $table->string('candidate_12th_marks')->nullable();
            $table->string('candidate_12th_institution_name')->nullable();
            $table->string('candidate_12th_medium')->nullable();
            $table->string('candidate_graduation_subject')->nullable();
            $table->string('candidate_graduation_percentages')->nullable();
            $table->string('candidate_graduation_institution_name')->nullable();
            $table->string('candidate_graduation_medium')->nullable();
            $table->string('candidate_pg/deploma_subject')->nullable();
            $table->string('candidate_pg/deploma_percentages')->nullable();
            $table->string('candidate_pg/deploma_institution_name')->nullable();
            $table->string('candidate_pg/deploma_medium')->nullable();
            $table->string('candidate_reference_person_name')->nullable();
            $table->string('candidate_if_ready_to_go_outside_bikaner')->nullable();
            $table->enum('candidate_have_DL_status',['Yes,No'])->nullable();
            $table->enum('candidate_have_PAN_status',['Yes,No'])->nullable();
            $table->string('candidate_soft_skills')->nullable();
            $table->longText('candidate_any_special_knowledge')->nullable();
            $table->longText('candidate_any_medical_problem')->nullable();
            $table->string('candidate_any_habits')->nullable();
            $table->string('candidate_expected_salary')->nullable();
            $table->string('candidate_signature')->nullable();
            $table->date('candidate_form_filling_date')->nullable();
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
        Schema::dropIfExists('interviews');
    }
}
