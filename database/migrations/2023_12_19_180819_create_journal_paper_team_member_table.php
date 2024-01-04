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
        Schema::create('journal_paper_team_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journal_paper_id');
            $table->unsignedBigInteger('team_member_id');
            $table->timestamps();

            $table->foreign('journal_paper_id')->references('id')->on('journal_papers')->onDelete('cascade');
            $table->foreign('team_member_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_paper_team_member');
    }
};
