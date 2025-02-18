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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id('meeting_id');
            $table->foreignId('auth_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('meeting_theme');
            $table->foreignId('meeting_minutes')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('meeting_leader')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('participant_count');
            $table->foreignId('room_id')->constrained('rooms', 'room_id')->onDelete('cascade');
            $table->string('status')->default('Menunggu Pengajuan');
            $table->timestamps();
        });
    }

   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
