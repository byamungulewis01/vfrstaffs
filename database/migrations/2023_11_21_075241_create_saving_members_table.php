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
        Schema::create('saving_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('saving_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('type',['deposit', 'withdraw'])->default('deposit');
            $table->enum('status', ['requested', 'approved', 'rejected'])->default('requested');
            $table->integer('amount');
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_members');
    }
};
