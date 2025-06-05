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
        Schema::create('subdistrict', function (Blueprint $table) {
            $table->increments('subdistrict_id')->unsigned();
            $table->unsignedInteger('city_id');
            $table->string('subdistrict_name');
            $table->primary('subdistrict_id');
        });
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('subdistrict_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdistrict');
    }
};
