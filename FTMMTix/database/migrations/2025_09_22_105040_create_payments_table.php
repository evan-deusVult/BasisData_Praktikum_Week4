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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('amount');
            $table->enum('status',['PENDING','AWAITING_CONFIRMATION','PAID','FAILED'])->default('PENDING');
            $table->timestamp('paid_at')->nullable();
            $table->string('transfer_ref')->nullable();  // nomor referensi/berita
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
