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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subheading')->nullable();
            $table->string('slug')->unique();
            $table->text('content');
            $table->integer('category_id')->unsigned();
            $table->integer('views')->unsigned()->default(0);
            $table->string('image')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
