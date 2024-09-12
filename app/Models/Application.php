<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';

    protected $primaryKey = 'id_application';


    protected $fillable = [
        'status',
    ];

    public function jobApplication()
    {
        return $this->belongsTo(FormJob::class, 'id_application', 'id');
    }

    public function applicantJob()
    {
        return $this->belongsTo(ApplicantJob::class, 'id_job');
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class, 'id_interview');
    }
}
