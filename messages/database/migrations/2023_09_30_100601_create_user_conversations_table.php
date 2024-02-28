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
        Schema::create('user_conversations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->timestamp('date_joined')->useCurrent();
            $table->unsignedBigInteger('last_seen_message_id')->nullable();
            $table->foreign('last_seen_message_id')->references('id')->on('messages')->onDelete('set null');
            $table->primary(['user_id', 'conversation_id']); // Kết hợp khóa chính
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_conversations');
    }
};
