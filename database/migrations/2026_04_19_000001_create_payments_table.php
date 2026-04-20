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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('borrow_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['purchase', 'borrow']);
            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamp('paid_at')->nullable();
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
