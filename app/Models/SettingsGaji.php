<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsGaji extends Model
{
    protected $table = 'settingsgaji';

    protected $primaryKey = 'id_setting';

    use HasFactory;

    protected $fillable = [
        'bpjs',
        'pajak',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
