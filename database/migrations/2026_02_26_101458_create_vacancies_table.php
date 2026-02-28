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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->string('slug')->unique();
            $table->string('position');
            $table->string('employment_type');
            $table->string('schedule');
            $table->integer('salary_min')->unsigned()->nullable();
            $table->integer('salary_max')->unsigned()->nullable();
            $table->boolean('contractual')->default(false);
            $table->string('experience');
            $table->string('format');
            $table->string('organization');
            $table->string('city_name');
            $table->string('address');
            $table->string('charge');
            $table->string('requirement')->nullable();
            $table->string('conditions')->nullable();
            $table->string('additional')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
