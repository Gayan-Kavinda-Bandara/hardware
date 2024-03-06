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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('device_id')->nullable()->constrained('devices');
            $table->foreignId('section_id')->nullable()->constrained('sections');
            $table->string('issue')->nullable();
            $table->string('assDremarks')->nullable();
            $table->integer('assDremarksState')->default(1);
            $table->string('techRemarks')->nullable();
            $table->integer('hddformat')->default(1);
            $table->integer('techRemarksState')->default(1);
            $table->integer('comCanRepair')->default(1);
            $table->string('assITRemarks')->nullable();
            $table->string('assITRemarksState')->nullable();
            $table->string('ItDRemarks')->nullable();
            $table->string('ItDRemarksState')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
