<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->string('project_name');
            $table->text('project_description');
            $table->string('project_file')->nullable();
            $table->string('project_category')->nullable();
            $table->string('client');
            $table->unsignedBigInteger('hod_id');
            $table->timestamps();
            $table->foreign('hod_id')->references('hod_id')->on('hod')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
