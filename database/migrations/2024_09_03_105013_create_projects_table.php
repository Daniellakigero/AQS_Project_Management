<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id'); // Primary Key
            $table->string('project_name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->string('created_by');
            $table->unsignedBigInteger('hod_id'); // Assuming hods table
            $table->unsignedBigInteger('emp_id');
            $table->timestamps();
            $table->foreign('emp_id')->references('emp_id')->on('employeed')->onDelete('cascade');
            $table->foreign('hod_id')->references('hod_id')->on('hod')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('projects');
    }
    
};
