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
        Schema::create('summary_photos', function (Blueprint $table) {
            $table->bigIncrements('photo_id');
            $table->unsignedBigInteger('summary_id');
            $table->string('photo_path'); // Menyimpan path foto
            $table->timestamps();

            $table->foreign('summary_id')->references('summary_id')->on('summaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_photos');
    }
};
