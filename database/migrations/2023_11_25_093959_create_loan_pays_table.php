<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_pays', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->integer('interest');
            $table->string('comment');
            $table->enum('status', ['requested', 'approved', 'rejected'])->default('requested');
            $table->foreignId('loan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_pays');
    }
};
