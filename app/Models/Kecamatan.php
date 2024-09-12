<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the model name
    protected $table = 'kecamatan';

    // Specify the primary key
    protected $primaryKey = 'id_kecamatan';


    protected $fillable = [
        'id_kabupaten', // Make sure id_kabupaten is already listed here if necessary
        'kecamatan',
    ];

    // If the primary key is not an incrementing integer, specify its type
    public $incrementing = true;
    protected $keyType = 'int';

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id_kabupaten');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_kecamatan');
    }
}
