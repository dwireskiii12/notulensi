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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default(4);
            $table->string('position')->nullable();
            $table->char('phone_number')->nullable();
            $table->string('faculty')->nullable();
            $table->string('study_program')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('original_user_id')->nullable();
            $table->rememberToken();

             // Add foreign key constraint
             $table->foreign('original_user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
