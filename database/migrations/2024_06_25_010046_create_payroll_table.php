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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id('id_payroll', 40);
            $table->string('kode_payroll', 100);
            $table->date('tgl_payroll');
            $table->time('waktu_payroll');
            $table->unsignedBigInteger('id_pegawai');
            $table->string('nama_jabatan', 50);
            $table->string('nama_bagian', 50);
            $table->string('bpjs', 40);
            $table->string('pajak', 40);
            $table->string('status', 10);
            $table->date('tgl_generate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};
