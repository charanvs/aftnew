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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number');
            $table->string('petitioner');
            $table->string('respondent');
            $table->string('petitioner_advocate');
            $table->string('respondent_advocate');
            $table->date('date');
            $table->string('type'); // Judgement, Admission, etc.
            $table->foreignId('corum_id')->constrained('corums');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
