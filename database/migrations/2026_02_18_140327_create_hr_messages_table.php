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
        Schema::create('hr_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('head_hunter_id')->constrained('head_hunters')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('theme');
            $table->string('message');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_messages');
    }
};
