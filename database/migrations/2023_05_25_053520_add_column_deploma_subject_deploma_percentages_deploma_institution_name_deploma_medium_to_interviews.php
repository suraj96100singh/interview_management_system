<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDeplomaSubjectDeplomaPercentagesDeplomaInstitutionNameDeplomaMediumToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->string('candidate_pg_or_deploma_subject',100)->nullable();
            $table->string('candidate_pg_or_deploma_percentages',100)->nullable();
            $table->string('candidate_pg_or_deploma_institution_name',100)->nullable();
            $table->string('candidate_pg_or_deploma_medium',100)->nullable(); 
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
            $table->string('candidate_pg_or_deploma_subject',100)->nullable();
            $table->string('candidate_pg_or_deploma_percentages',100)->nullable();
            $table->string('candidate_pg_or_deploma_institution_name',100)->nullable();
            $table->string('candidate_pg_or_deploma_medium',100)->nullable();
        });
    }
}
