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
            $table->string('status')->nullable();
            $table->string('housing_type');
            $table->boolean('housing_permission');
            $table->boolean('housing_condition');
            $table->text('pet_experience')->nullable();
            $table->string('residency_duration');
            $table->string('planned_residency_duration');
            $table->string('future_residency_country')->nullable();
            $table->boolean('pet_migration_plan'); 
            $table->string('job'); 
            $table->string('house_occupants')->nullable();
            $table->string('canine_residence')->nullable();
            $table->boolean('vaccinated'); 
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
