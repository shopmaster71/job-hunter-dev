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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->string('slug')->unique();
            $table->string('patronymic')->nullable();
            $table->string('city_name');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('citizenship');
            $table->string('education');
            $table->boolean('driving_licence')->default(false);
            $table->boolean('married')->default(false);
            $table->boolean('children')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
