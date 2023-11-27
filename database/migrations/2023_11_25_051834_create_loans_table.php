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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan');
            $table->integer('interest');
            $table->integer('installement');
            $table->string('comment');
            $table->enum('loan_status',['open', 'closed'])->default('open');
            $table->enum('status', ['requested', 'approved', 'rejected']);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('loan_type')->constrained('loan_settings')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
