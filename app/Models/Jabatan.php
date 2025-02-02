<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
        'tunjangan',
        'benefit1',
        'benefit2',
        'benefit3'
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan');
    }
}
