<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crews', function (Blueprint $table) {
            $table->id();

            // Crew fields
            $table->string('first_name', 150);
            $table->string('last_name', 150);

            // Foreign key to ships
            $table->unsignedBigInteger('ship_id')->nullable();
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('set null');

            // Role as ENUM
            $table->enum('role', [
                'Captain',
                'Chief Officer',
                'Able Seaman',
                'Ordinary Seaman',
                'Engine Cadet',
                'Radio Officer',
                'Chief Cook',
                'Steward',
                'Deckhand',
                'Other'
            ])->default('Captain');

            $table->string('phone_number', 30)->unique();
            $table->string('nationality', 100)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crews');

    }
}
