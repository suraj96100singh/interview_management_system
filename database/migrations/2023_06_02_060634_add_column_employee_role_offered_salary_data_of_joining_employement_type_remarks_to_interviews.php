<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmployeeRoleOfferedSalaryDataOfJoiningEmployementTypeRemarksToInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->string('employee_role')->nullable();
            $table->string('employee_offered_salary')->nullable();
            $table->date('employee_date_of_joining')->nullable();
            $table->string('employement_type')->nullable();
            $table->longText('employee_remarks')->nullable();
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
            $table->string('employee_role')->nullable();
            $table->string('employee_offered_salary')->nullable();
            $table->date('employee_date_of_joining')->nullable();
            $table->string('employement_type')->nullable();
            $table->longText('employee_remarks')->nullable();
        });
    }
}
