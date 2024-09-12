<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'agama',
        'status_nikah',
        'warga_negara',
        'nip',
        'photo',
        'status_pegawai',
        'tgl_masuk',
        'id_bagian',
        'id_jabatan',
        'gaji_pokok',
        'tunjangan',
        'bpjs',
        'pajak',
        'no_rek',
        'nama_rek',
        'no_hp',
        'email',
        'username',
        'password',
        'usertype',
        'about',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function payroll()
    {
        return $this->hasMany(Payroll::class, 'id_payroll', 'nama');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function provinsi()
    {
        return $this->belongsTo(Kabupaten::class, 'id_provinsi');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absen');
    }
}
