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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('students');
            $table->foreignId('lecturer_id')->nullable()->constrained('lecturers');
            $table->string('code')->unique();         // e.g., FTMM-2025-XXXX
            $table->enum('status',['UNPAID','PAID','CANCELLED','EXPIRED'])->default('UNPAID');
            $table->unsignedInteger('total_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
