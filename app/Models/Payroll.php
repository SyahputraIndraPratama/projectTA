<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $table = 'payroll';

    protected $primaryKey = 'id_payroll';

    protected $fillable = [
        'kode_payroll',
        'tgl_payroll',
        'waktu_payroll',
        'id_pegawai',
        'nama_jabatan',
        'nama_bagian',
        'hadir',
        'sakit',
        'alpha',
        'telat',
        'bpjs',
        'pajak',
        'status',
        'channel_bayar',
        'qr_code',
        'tgl_generate',
    ];

    // Define relationships if necessary
    // For example, a payroll belongs to an employee
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
