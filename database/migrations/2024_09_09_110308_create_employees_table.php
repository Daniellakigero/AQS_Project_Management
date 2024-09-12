<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     Schema::create('employeed', function (Blueprint $table) {
    $table->id('emp_id');
    $table->string('emp_fullname');
    $table->string('email_company');
    $table->string('department');
    $table->string('position');
    $table->string('defaultPassword');
    $table->string('email_personal');
    $table->boolean('processed')->nullable(); // Allows NULL values
    $table->boolean('verified')->nullable();  // Allows NULL values
    $table->unsignedBigInteger('hod_id');
    $table->timestamps();
    $table->foreign('hod_id')->references('hod_id')->on('hod')->onDelete('cascade');
});

    }

 public function down(): void
{

    Schema::dropIfExists('employeed');
}

};
