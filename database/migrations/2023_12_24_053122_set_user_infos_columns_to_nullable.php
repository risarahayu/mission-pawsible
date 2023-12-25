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
        Schema::table('user_infos', function (Blueprint $table) {
            $table->date('birthday')->nullable()->change();
            $table->string('whatsapp')->nullable()->change();
            $table->string('facebook')->nullable()->change();
            $table->string('instagram')->nullable()->change();
            $table->string('street_address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('postal')->nullable()->change();
            $table->string('map_link')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->date('birthday')->nullable()->change();
            $table->string('whatsapp')->nullable()->change();
            $table->string('facebook')->nullable()->change();
            $table->string('instagram')->nullable()->change();
            $table->string('street_address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('postal')->nullable()->change();
            $table->string('map_link')->nullable()->change();
        });
    }
};
