<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';

    protected $primaryKey = 'id_provinsi';

    protected $fillable = ['provinsi'];

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi', 'id_provinsi');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_provinsi');
    }
}
