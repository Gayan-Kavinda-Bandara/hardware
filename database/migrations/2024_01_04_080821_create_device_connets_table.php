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
        Schema::create('device_connets', function (Blueprint $table) {
            $table->foreignId('device_id')->nullable()->constrained('devices');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('assign_date');
            $table->string('release_date')->nullable();
            $table->integer('state')->default(1);
            $table->timestamps();
            $table->primary(['device_id', 'user_id'])->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_connets');
    }
};
