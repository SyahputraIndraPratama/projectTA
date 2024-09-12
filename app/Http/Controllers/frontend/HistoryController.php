<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use App\Models\Application;
use App\Models\FormJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryController extends Controller
{
    public function showHistori()
    {
        $userId = auth()->id();

        // Mengambil data aplikasi pekerjaan berdasarkan user yang sedang login menggunakan relasi
        $applications = FormJob::with('applicantJobs')
            ->where('user_id', $userId)
            ->get();

        return view('frontend.history', compact('applications'));
    }

    public function verify($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'verified';
        $application->save();
        Alert::success('Success', 'Application verified successfully', '1500');
        return to_route('schedule.index');
    }

    public function interview($id)
    {
        $applications = Application::where('id_application', $id)->firstOrFail();
        $applications->status = 'interview';
        $applications->save();

        Alert::success('Success', 'Interview scheduled successfully', '1500');
        return to_route('schedule.index', compact('applications'));
    }

    public function accept($id)
    {
        $applications = FormJob::where('id', $id)->firstOrFail();
        $applications->status = 'accepted';
        $applications->save();

        Alert::success('Success', 'Application accepted successfully', '1500');
        return to_route('schedule.index', compact('applications'));
    }

    public function reject($id)
    {
        $application = FormJob::where('id', $id)->firstOrFail();
        $application->status = 'rejected';
        $application->save();
        Alert::success('Success', 'Application rejected successfully', '1500');
        return to_route('hrd.apply.index', compact('application'));
    }
}
