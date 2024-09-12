<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function home($identifier)
    {
        $job = ApplicantJob::where('id_job', $identifier)->orWhere('jobname', $identifier)->firstOrFail();

        return view('lowongan.detail', compact('job'));
    }
}
