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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id')->index();
            $table->string('patient_id');
            $table->string('date');
            $table->string('time');
            $table->enum('status', ['pending', 'cancelled', 'toCheckup', 'processed', 'declined', 'deleted'])->default('pending');
            $table->string('note')->nullable();
            $table->boolean('has_rate')->default(false);
            $table->timestamps();
            $table->unique(['date', 'time']);
            $table->foreign('patient_id')->references('custom_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
}; 