<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyCandidatepgToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            // $table->renameColumn('candidate_pg/deploma_subject','candidate_pg_or_deploma_subject');
            // $table->renameColumn('candidate_pg/deploma_percentages','candidate_pg_or_deploma_percentages');
            // $table->renameColumn('candidate_pg/deploma_institution_name','candidate_pg_or_deploma_institution_name');
            // $table->renameColumn('candidate_pg/deploma_medium','candidate_pg_or_deploma_medium');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_subject TO candidate_pg_or_deploma_subject');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_percentages To candidate_pg_or_deploma_percentages');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_institution_name To candidate_pg_or_deploma_institution_name');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_medium To candidate_pg_or_deploma_medium');
            $table->dropColumn('candidate_pg/deploma_subject');
            $table->dropColumn('candidate_pg/deploma_percentages');
            $table->dropColumn('candidate_pg/deploma_institution_name');
            $table->dropColumn('candidate_pg/deploma_medium');
            $table->string('candidate_pg_or_deploma_subject');
            $table->string('candidate_pg_or_deploma_percentages');
            $table->string('candidate_pg_or_deploma_institution_name');
            $table->string('candidate_pg_or_deploma_medium');
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
            // $table->renameColumn('candidate_pg/deploma_subject','candidate_pg_or_deploma_subject');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_subject TO candidate_pg_or_deploma_subject');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_percentages To candidate_pg_or_deploma_percentages');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_institution_name To candidate_pg_or_deploma_institution_name');
            // DB::statement('ALTER TABLE interviews RENAME COLUMN candidate_pg/deploma_medium To candidate_pg_or_deploma_medium');
            $table->dropColumn('candidate_pg/deploma_subject');
            $table->dropColumn('candidate_pg/deploma_percentages');
            $table->dropColumn('candidate_pg/deploma_institution_name');
            $table->dropColumn('candidate_pg/deploma_medium');
            $table->string('candidate_pg_or_deploma_subject');
            $table->string('candidate_pg_or_deploma_percentages');
            $table->string('candidate_pg_or_deploma_institution_name');
            $table->string('candidate_pg_or_deploma_medium');


        });
    }
}
