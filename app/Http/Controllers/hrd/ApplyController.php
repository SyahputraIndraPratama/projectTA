<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\FormJob;
use App\Models\Interview;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewScheduled;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ApplyController extends Controller
{
    public function index()
    {
        // Fetch all job applications with related job details
        $applications = FormJob::all();

        // Pass the applications data to the view
        return view('hrd.apply_masuk', compact('applications'));
    }

    public function show()
    {
        // Fetch all job applications with related job details
        $applications = FormJob::all();

        // Pass the applications data to the view
        return view('hrd.apply_masuk', compact('applications'));
    }

    public function jadwal(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'alamat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pic' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
        ]);

        // Simpan data interview
        $interviewDetails = [
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'pic' => $request->pic,
            'telp' => $request->telp,
            'application_id' => $id, // Simpan ID aplikasi ke dalam tabel interview
        ];

        Interview::create($interviewDetails);

        // Ubah status aplikasi menjadi 'interview'
        $application = FormJob::findOrFail($id);
        $application->status = 'interview';
        $application->save();

        // Kirim email ke pelamar
        Mail::to($application->email)->send(new InterviewScheduled($application, $interviewDetails));

        Alert::success('Success', 'Interview berhasil dijadwalkan');
        return redirect()->route('jobs.show');
    }


    public function scheduleInterview(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|integer',
            'alamat' => 'required|string',
            'tanggal' => 'required|date',
            'pic' => 'required|string',
            'telp' => 'required|string'
        ]);

        // Create a new interview schedule
        $interview = new Interview();
        $interview->application_id = $request->input('id');
        $interview->alamat = $request->input('alamat');
        $interview->tanggal = $request->input('tanggal');
        $interview->pic = $request->input('pic');
        $interview->telp = $request->input('telp');
        $interview->save();

        // Redirect atau tampilkan pesan sukses
        Alert::success('Success', 'Data Berhasil ditambahkan', '1500');
        return to_route('hrd.apply.index');
    }

    public function viewResume($id)
    {
        // Find the application by ID
        $application = FormJob::findOrFail($id);

        // Check if resume exists
        if ($application->resume) {
            $resumePath = Storage::url('hrd/' . $application->resume);
            return redirect()->away($resumePath);
        } else {
            return redirect()->back()->with('error', 'Resume not found.');
        }
    }

    public function destroy($id)
    {
        // Find the application by ID and delete
        $application = FormJob::findOrFail($id);
        $application->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'Application deleted successfully.');
    }
}
