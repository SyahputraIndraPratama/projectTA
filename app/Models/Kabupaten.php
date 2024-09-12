<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupatens';

    // Specify the primary key
    protected $primaryKey = 'id_kabupaten';


    protected $fillable = [
        'id_provinsi', // Make sure id_provinsi is already listed here if necessary
        'kabupaten',
    ];

    // If the primary key is not an incrementing integer, specify its type
    public $incrementing = true;
    protected $keyType = 'int';

    // Define the relationship with Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id_provinsi');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_kabupaten');
    }
}
