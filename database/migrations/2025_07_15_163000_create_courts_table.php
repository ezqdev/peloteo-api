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
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_id')->constrained('sports')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('address');
            $table->decimal('address_lat', 10, 7)->nullable();
            $table->decimal('address_long', 10, 7)->nullable();
            $table->string('address_reference')->nullable();
            $table->enum('type', ['SYNTHETIC', 'LAND', 'GRASS']);
            $table->integer('max_players');
            $table->boolean('have_parking')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
}; 