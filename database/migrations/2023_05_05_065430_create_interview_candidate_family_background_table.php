<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewCandidateFamilyBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_candidate_family_background', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id')->references('id')->on('interviews');
            $table->string('candidate_relative_name')->nullable();
            $table->string('candidate_relative_relation')->nullable();
            $table->enum('candidate_relative_marriage_status',['Yes','No'])->nullable();
            $table->string('candidate_relative_age')->nullable();
            $table->string('candidate_relative_occupation')->nullable();
            $table->string('candidate_relative_health')->nullable();
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
        Schema::dropIfExists('interview_candidate_family_background');
    }
}
