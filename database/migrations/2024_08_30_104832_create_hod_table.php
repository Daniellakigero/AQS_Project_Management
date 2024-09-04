<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hod', function (Blueprint $table) {
            $table->id('hod_id');
            $table->string('hod_name');
            $table->string('email')->unique(); 
           // $table->string('phone_number')->nullable(); 
            $table->string('password'); 
            $table->timestamps(); 
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('hod');
    }
};
