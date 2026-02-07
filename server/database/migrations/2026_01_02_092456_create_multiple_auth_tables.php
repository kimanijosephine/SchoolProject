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
        // Schools Table
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Students Table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course_id')->nullable();
            $table->string('year_of_study');
            $table->string('class_year');
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Sponsors Table
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Relationship: Sponsors sponsoring Students
        Schema::create('sponsor_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable(); // Optional: Track funding amount
            $table->timestamps();
        });

        // Relationship: Sponsors sponsoring Schools
        Schema::create('sponsor_school', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsor_school');
        Schema::dropIfExists('sponsor_student');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('students');
        Schema::dropIfExists('sponsors');

    }
};
