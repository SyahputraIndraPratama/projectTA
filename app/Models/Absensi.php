<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; // Your table name

    protected $primaryKey = 'id_absen'; // Specify the primary key 

    protected $fillable = [
        'id_pegawai',
        'nip',
        'waktu',
        'keterangan',
        'estimated'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
