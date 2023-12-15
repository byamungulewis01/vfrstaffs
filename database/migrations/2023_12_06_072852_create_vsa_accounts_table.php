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
        Schema::create('vsa_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->enum('type', ['deposit', 'withdraw']);
            $table->enum('source', ['loan','saving','interest', 'other']);
            $table->string('comment');
            $table->foreignId('saving_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vsa_accounts');
    }
};
