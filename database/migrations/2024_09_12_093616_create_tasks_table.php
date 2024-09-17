<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
    Schema::create('tasks', function (Blueprint $table) {
    $table->id('task_id');
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('assign_to');
    $table->date('start_date')->nullable(); 
    $table->date('due_date')->nullable(); 
    $table->unsignedBigInteger('project_id');
    $table->unsignedBigInteger('emp_id');
    $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
    $table->foreign('emp_id')->references('emp_id')->on('employeed')->onDelete('cascade');
    $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
