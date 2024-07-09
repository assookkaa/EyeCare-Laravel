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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id');
            $table->string('patient_id');
            $table->string('appointment_id')->nullable();
            $table->string('os_sph')->nullable();
            $table->string('os_cyl')->nullable();
            $table->string('os_axis')->nullable();
            $table->string('od_sph')->nullable();
            $table->string('od_cyl')->nullable();
            $table->string('od_axis')->nullable();
            $table->string('add')->nullable();
            $table->string('pd')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('custom_id')->on('users')->onDelete('cascade');
            $table->foreign('appointment_id')->references('custom_id')->on('appointments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkups');
    }
};
