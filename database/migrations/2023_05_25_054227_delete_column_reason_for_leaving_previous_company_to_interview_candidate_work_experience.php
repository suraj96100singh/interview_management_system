<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnReasonForLeavingPreviousCompanyToInterviewCandidateWorkExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_candidate_work_experience', function (Blueprint $table) {
            $table->dropColumn('reason_for_leaving_previous_company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_candidate_work_experience', function (Blueprint $table) {
            //
        });
    }
}
