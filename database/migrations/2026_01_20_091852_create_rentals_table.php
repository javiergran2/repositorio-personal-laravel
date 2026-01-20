<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->date('rental_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->enum('status', ['active', 'completed', 'overdue', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            
            $table->index(['user_id', 'status']);
            $table->index(['movie_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};