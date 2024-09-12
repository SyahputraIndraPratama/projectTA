<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\FormJob;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public function index()
    {
        $schedules = DB::table('interviews')
            ->join('job_applications', 'interviews.id_interview', '=', 'job_applications.id')
            ->select(
                'interviews.id_interview as id_interview',
                'interviews.alamat',
                'interviews.tanggal',
                'interviews.pic',
                'interviews.telp',
                'job_applications.status as job_status',
            )
            ->get();

        return view('hrd.interview', compact('schedules'));
    }
}
