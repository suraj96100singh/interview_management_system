<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeStartTimeAndEndTimeDefaultNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department', function (Blueprint $table) {
           
           DB::statement('alter TABLE department
           MODIFY shift_start_time time DEFAULT null');
           DB::statement('alter TABLE department
           MODIFY shift_end_time time DEFAULT null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department', function (Blueprint $table) {
       
        });
    }
}



// ------------
// $table->bigIncrements('id');
// $table->string('system_user_name',50);
// $table->string('system_user_email',50);

// 
// $table->bigInteger('system_user_department_id')->unsigned();
// $table->foreign('system_user_department_id')->references('id')->on('department')->onDelete('cascade');

// $table->timestamps();

