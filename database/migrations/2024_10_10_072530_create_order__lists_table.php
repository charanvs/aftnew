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
        Schema::create('order__lists', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no');
            $table->string('applicants');
            $table->string('padvocate');
            $table->string('radvocate');
            $table->string('coram');
            $table->date('date_of_order');
            $table->integer('court_no');
            $table->string('sno_cause_list');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__lists');
    }
};
