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
        Schema::create('case_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('sid');
            $table->string('diaryno');
            $table->string('registration_no');
            $table->string('dor');
            $table->string('case_type');
            $table->string('file_no');
            $table->string('year');
            $table->string('applicant');
            $table->string('respondent');
            $table->string('padvocate');
            $table->string('radvocate');
            $table->string('status');
            $table->string('location');
            $table->string('dol');
            $table->string('doion');
            $table->string('doson');
            $table->string('dofc');
            $table->string('dofr');
            $table->string('additionalremark');
            $table->string('jro');
            $table->string('reopened');
            $table->string('published');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_registrations');
    }
};
