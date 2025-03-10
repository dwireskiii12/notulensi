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
        Schema::create('meeting_facilities', function (Blueprint $table) {
            $table->id('mef_id');
            $table->unsignedBigInteger('meeting_id');
            $table->text('facilities_name');
            $table->timestamps();
            $table->foreign('meeting_id')->references('meeting_id')->on('meetings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_facilities');
    }
};
