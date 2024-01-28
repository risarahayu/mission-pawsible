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
        Schema::table('dogs', function (Blueprint $table) {
            // Mengubah kolom sterilization_date menjadi nullable
            $table->date('sterilization_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            // Mengembalikan perubahan jika diperlukan
            $table->date('sterilization_date')->change();
        });
    }
};
