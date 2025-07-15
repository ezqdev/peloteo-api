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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->decimal('current_location_lat', 10, 7)->nullable();
            $table->decimal('current_location_long', 10, 7)->nullable();
            $table->string('avatar_url')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('ci', 10)->nullable();
            $table->string('ci_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('extra_phone_number')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
