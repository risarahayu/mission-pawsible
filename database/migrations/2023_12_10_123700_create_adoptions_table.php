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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('dog_id');
            $table->foreign('dog_id')->references('id')->on('dogs');
            $table->string('status')->nullable()->default('pending');
            $table->string('housing_type')->nullable();
            $table->boolean('housing_permission')->nullable();
            $table->boolean('housing_condition')->nullable();
            $table->text('pet_experience')->nullable();
            $table->string('residency_duration')->nullable();
            $table->string('planned_residency_duration')->nullable();
            $table->string('future_residency_country')->nullable();
            $table->boolean('pet_migration_plan')->nullable();
            $table->string('job')->nullable();
            $table->string('house_occupants')->nullable();
            $table->string('canine_residence')->nullable();
            $table->boolean('vaccinated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
