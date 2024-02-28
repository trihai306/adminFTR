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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('reply_to_id')->nullable(); // Trường mới
            $table->foreign('reply_to_id')->references('id')->on('messages')->onDelete('set null'); // Khóa ngoại mới
            $table->text('content')->nullable();
            $table->enum('type', ['text', 'images', 'videos', 'links','files','audios']);
            $table->json('attachment_url')->nullable();
            $table->timestamps(); // Tự động thêm cột created_at và updated_at
            $table->softDeletes(); // Cho phép Soft Deletes
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
