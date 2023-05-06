<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department_name');
            $table->bigInteger('head_of_department')->unsigned();
            $table->foreign('head_of_department')->references('id')->on('users')->onDelete('cascade');
            $table->string('department_email');
            $table->string('department_phone_number');
            $table->longText('department_address');
            $table->string('department_working_hours');//changes
            $table->time('shift_start_time');
            $table->time('shift_end_time');
            $table->text('department_image');
            $table->enum('department_status',['Active','Inactive']);
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
        Schema::dropIfExists('department');
    }
}
