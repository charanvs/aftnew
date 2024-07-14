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
        Schema::create('judgements', function (Blueprint $table) {
            $table->id();
            $table->string('regno');
            $table->string('case_type');
            $table->string('file_no');
            $table->string('year');
            $table->string('associated');
            $table->string('dor');
            $table->string('deptt');
            $table->string('deptt_code');
            $table->string('subject');
            $table->string('subject_code');
            $table->string('petitioner');
            $table->string('respondent');
            $table->string('padvocate');
            $table->string('radvocate');
            $table->string('corum');
            $table->string('court_no');
            $table->string('gno');
            $table->string('appeal');
            $table->string('jro');
            $table->string('dod');
            $table->string('mod');
            $table->string('dpdf');
            $table->string('remarks');
            $table->string('headnotes');
            $table->string('citation');
            $table->string('location');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judgements');
    }
};
