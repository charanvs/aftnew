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
        Schema::create('scrutinies', function (Blueprint $table) {
            $table->id();
            $table->string('diary_no');
            $table->string('date');
            $table->string('presented_by');
            $table->string('nature_of_doc');
            $table->string('reviewed_by');
            $table->string('associated_with');
            $table->string('date_of_presentation');
            $table->string('nature_of_greivance');
            $table->string('nature_of_greivance_code');
            $table->string('subject');
            $table->string('subject_code');
            $table->string('result');
            $table->text('so_remark');
            $table->text('dr_remark');
            $table->text('pr_remark');
            $table->string('pending_observations');
            $table->string('casetype');
            $table->string('no_of_applicants');
            $table->string('no_of_respondents');
            $table->string('initial');
            $table->text('remark');
            $table->text('ca_remark');
            $table->text('notification_remark');
            $table->string('notification_date');
            $table->string('nature_of_greivance_other');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrutinies');
    }
};
