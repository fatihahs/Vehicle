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
        Schema::create('vehicle_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ResidentID');
            $table->string('status', 10);
            $table->timestamps();

            //FK
            $table->foreign('ResidentID')->references('id')->on('residents')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_log');
    }
};
