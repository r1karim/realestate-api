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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['h','a'])->default('a'); // House or apartment
            $table->string("address");
            $table->integer("size"); //supposedly in m2
            $table->integer("number_of_bedrooms");
            $table->float("geolat")->nullable();
            $table->float("geolng")->nullable();
            $table->integer("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
