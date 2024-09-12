<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $now = Carbon::now(); // Waktu saat ini

        // Mengambil pekerjaan aktif dan memfilter berdasarkan batas durasi dan tanggal berakhir
        $activeJobs = ApplicantJob::where('status', 'Active')
        ->where(function ($query) use ($now) {
            $query->whereRaw('DATE_ADD(tgl_posting, INTERVAL durasi DAY) >= ?', [$now])
                ->orWhere('close_date', '>=', $now);
        })
        ->get();


        return view('frontend.homepage', compact('activeJobs'));
    }
}
