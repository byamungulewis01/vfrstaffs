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
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->string('comment');
            $table->enum('type',['deposit', 'withdraw'])->default('deposit');
            $table->enum('status', ['requested', 'approved', 'rejected']);
            $table->foreignId('saving_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
