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
        Schema::create('music', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('events_id');
            $table->foreign('events_id')
                ->references('id')->on('events')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('mp4');
            $table->string('video');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
