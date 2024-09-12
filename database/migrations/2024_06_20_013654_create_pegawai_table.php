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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai', 40);
            $table->string('nik', 30);
            $table->string('nama', 30);
            $table->string('tempat_lahir', 20);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat', 100);
            $table->string('provinsi', 50);
            $table->string('kabupaten', 50);
            $table->string('kecamatan', 50);
            $table->string('agama', 50);
            $table->string('status_nikah', 30);
            $table->string('warga_negara', 30);
            $table->text('photo', 40);
            $table->string('status_pegawai', 30);
            $table->date('tgl_masuk');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_bagian');
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan', 15, 2);
            $table->string('bpjs', 40);
            $table->string('pajak', 30);
            $table->string('no_rek', 30);
            $table->string('nama_rek', 50);
            $table->string('no_hp', 15);
            $table->string('email', 50)->unique();
            $table->string('username', 40);
            $table->string('password', 100);
            $table->string('usertype', 20)->default('2'); // Nilai default 2
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
