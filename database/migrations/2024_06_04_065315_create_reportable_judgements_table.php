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
        Schema::create('reportable_judgements', function (Blueprint $table) {
            $table->id();
            $table->string('regno');
            $table->string('petitioner');
            $table->date('dod');
            $table->string('location');
            $table->string('pdffile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportable_judgements');
    }
};
