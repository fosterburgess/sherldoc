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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('disk')->nullable();
            $table->integer('size')->nullable();
            $table->text('contents')->nullable();
            $table->text('document')->nullable();
            $table->text('summary')->nullable();
            $table->dateTime('extracted_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
