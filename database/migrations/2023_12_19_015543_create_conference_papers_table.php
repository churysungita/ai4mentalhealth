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
        Schema::create('conference_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->string('pdf_path');
            $table->string('image_path')->nullable();
            $table->date('publication_date');
            $table->json('team_members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_papers');
    }
};
