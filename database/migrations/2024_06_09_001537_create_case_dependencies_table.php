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
        Schema::create('case_dependencies', function (Blueprint $table) {
            $table->id();
            $table->integer('regid');
            $table->string('matter');
            $table->string('coram');
            $table->integer('courtno');
            $table->date('dol');
            $table->integer('benchorder');
            $table->text('notice');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_dependencies');
    }
};
