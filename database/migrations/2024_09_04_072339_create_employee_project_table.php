<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('emp_id')->references('emp_id')->on('employeed')->onDelete('cascade');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');

            $table->index(['emp_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_project');
    }
};
