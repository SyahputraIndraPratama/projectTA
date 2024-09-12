<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $table = 'interviews'; // Nama tabel yang dihubungkan dengan model

    protected $primaryKey = 'id';

    protected $fillable = [
        'alamat',
        'tanggal',
        'pic',
        'telp',
    ];

    public function jobApplications()
    {
        return $this->belongsTo(FormJob::class, 'id');
    }

    public function applicant_jobs()
    {
        return $this->belongsTo(ApplicantJob::class, 'id_job');
    }
}
