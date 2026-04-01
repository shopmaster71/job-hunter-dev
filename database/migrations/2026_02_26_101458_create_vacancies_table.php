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
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('position');
            $table->integer('industry_id')->unsigned();
            $table->integer('specialization_id')->unsigned();
            $table->integer('employment_type_id')->unsigned();
            $table->integer('expertise_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->integer('salary_min')->unsigned()->nullable();
            $table->integer('salary_max')->unsigned()->nullable();
            $table->boolean('contractual')->default(false);
            $table->integer('format_id')->unsigned();
            $table->string('organization');
            $table->string('city_name');
            $table->string('address');
            $table->text('charge');
            $table->text('requirement')->nullable();
            $table->text('conditions')->nullable();
            $table->json('additional')->nullable();
            $table->integer('status')->default(0);
            $table->index(['slug', 'status']);
            $table->index('industry_id');           // Для фильтрации и связей
            $table->index('specialization_id');     //
            $table->index('employment_type_id');    //
            $table->index('schedule_id');           //
            $table->index('format_id');             //
            $table->index('status');                // Уже есть в составном, но отдельный ускорит WHERE status = 0
            $table->index('created_at');            // Для сортировки по дате
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
