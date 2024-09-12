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
        Schema::create('applicant_jobs', function (Blueprint $table) {
            $table->id('id_job', 40);
            $table->string('jobname', 50);
            $table->string('deskripsi', 100);
            $table->text('requirement');
            $table->string('img', 50);
            $table->string('company_name', 30); // Menambah kolom company_name
            $table->string('location', 100); // Menambah kolom location
            $table->string('tipe_pekerjaan', 30);
            $table->string('durasi', 50);
            $table->decimal('salary', 10, 2)->nullable(); // Menambah kolom salary
            $table->date('tgl_posting');
            $table->date('close_date');
            $table->string('status', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_jobs');
    }
};
