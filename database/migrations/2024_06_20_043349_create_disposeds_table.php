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
        Schema::create('disposeds', function (Blueprint $table) {
            $table->id();
            $table->integer('regid');
            $table->integer('sid');
            $table->string('gno');
            $table->tinyInteger('appeal');
            $table->string('jro');
            $table->string('dod');
            $table->string('mode');
            $table->string('dpdf');
            $table->text('remarks');
            $table->string('diaryno');
            $table->string('dor');
            $table->string('regno');
            $table->string('case_type');
            $table->string('file_no');
            $table->string('year');
            $table->string('associatedwith');
            $table->string('petitioner');
            $table->string('deptt');
            $table->string('deptt_code');
            $table->string('subject');
            $table->string('subject_code');
            $table->string('coram');
            $table->string('coramid');
            $table->string('courtno');
            $table->string('status');
            $table->string('matter');
            $table->integer('matter_code');
            $table->string('doion');
            $table->string('doson');
            $table->string('dofc');
            $table->string('padvocate');
            $table->string('radvocate');
            $table->string('respondent');
            $table->string('headnotes');
            $table->string('citation');
            $table->string('reopen');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposeds');
    }
};
