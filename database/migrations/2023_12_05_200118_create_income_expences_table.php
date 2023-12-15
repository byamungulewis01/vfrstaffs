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
        Schema::create('income_expences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->enum('status', ['requested', 'approved', 'rejected'])->default('requested');
            $table->enum('type', ['income', 'expense']);
            $table->enum('source', ['interest', 'other']);
            $table->string('comment');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_expences');
    }
};
