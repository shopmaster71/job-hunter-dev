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
        Schema::create('hr_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('head_hunter_id')->constrained('head_hunters')->onDelete('cascade');
            $table->integer('sector');
            $table->string('city_name');
            $table->string('advantage')->nullable();
            $table->boolean('top')->nullable()->default(false);
            $table->boolean('abroad')->nullable()->default(false);
            $table->string('about');
            $table->integer('experience');
            $table->string('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_information');
    }
};
