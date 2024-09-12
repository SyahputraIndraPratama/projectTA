<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormJob extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'jobname',
        'name',
        'email',
        'phone',
        'linkedin',
        'resume',
        'coverletter',
        'status'
    ];

    protected $table = 'job_applications';

    public function applicantJobs()
    {
        return $this->hasOne(ApplicantJob::class, 'id_job');
    }

    public function application()
    {
        return $this->hasOne(Application::class, 'id_application');
    }

    public function interview()
    {
        return $this->hasOne(Interview::class, 'id_interview');
    }
}
