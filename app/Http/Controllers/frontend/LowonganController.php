<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $activeJobs = ApplicantJob::all();

        return view('lowongan.job', compact('activeJobs'));
    }

    public function showJobDetails($jobname)
    {
        // Mengambil detail pekerjaan berdasarkan jobname
        $job = ApplicantJob::where('jobname', $jobname)->firstOrFail();

        return view('lowongan.detail', compact('job'));
    }
}
