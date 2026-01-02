<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsorship_requests', function (Blueprint $table) {
            $table->id();
            // Who is asking?
            $table->foreignId('school_id')->constrained()->onDelete('cascade');

            // Is this for a specific student? (Optional, can be null if for the school general fund)
            $table->foreignId('student_id')->nullable()->constrained()->onDelete('cascade');

            // Request Details
            $table->string('title'); // e.g., "Tuition for Semester 2"
            $table->text('description');

            // Financials
            $table->decimal('amount_needed', 12, 2);
            $table->decimal('amount_raised', 12, 2)->default(0);

            // Management
            $table->enum('status', ['pending', 'approved', 'funded', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorship_requests');
    }
};
