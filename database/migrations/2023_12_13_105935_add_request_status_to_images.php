<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestStatusToImages extends Migration
{
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->enum('request_status', ['requested', 'rescuer'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('request_status');
        });
    }
}

