<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDeplomaSubjectDeplomaPercentagesDeplomaInstitutionNameDeplomaMediumToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn('candidate_pg_or_deploma_subject');
            $table->dropColumn('candidate_pg_or_deploma_percentages');
            $table->dropColumn('candidate_pg_or_deploma_institution_name');
            $table->dropColumn('candidate_pg_or_deploma_medium');
           
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
            $table->dropColumn('candidate_pg_or_deploma_subject');
            $table->dropColumn('candidate_pg_or_deploma_percentages');
            $table->dropColumn('candidate_pg_or_deploma_institution_name');
            $table->dropColumn('candidate_pg_or_deploma_medium');
        });
    }
}
