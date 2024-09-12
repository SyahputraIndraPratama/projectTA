<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantJob extends Model
{
    use HasFactory;

    protected $table = 'applicant_jobs';

    protected $primaryKey = 'id_job';

    protected $fillable = [
        'jobname',
        'deskripsi',
        'requirement',
        'img',
        'close_date',
        'status',
    ];

    public function interviews()
    {
        return $this->belongsTo(interview::class, 'id');
    }

    public function jobApplication()
    {
        return $this->hasOne(JobApplication::class, 'id_job', 'id');
    }

    public function formJob()
    {
        return $this->belongsTo(FormJob::class, 'id', 'id_job');
    }

    public function application()
    {
        return $this->hasOne(Application::class, 'id_application');
    }
}
