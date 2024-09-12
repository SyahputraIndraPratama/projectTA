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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('jobname', 30)->nullable()->constrained('applicant_jobs');
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('phone', 15);
            $table->string('linkedin', 100)->nullable();
            $table->string('resume', 30)->nullable();
            $table->text('coverletter', 40)->nullable();
            $table->string('status', 50)->default('Menunggu Tanggapan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
