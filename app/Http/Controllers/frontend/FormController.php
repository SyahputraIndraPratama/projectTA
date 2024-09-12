<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use App\Models\FormJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function home($identifier)
    {
        $user = Auth::user();
        $apply = ApplicantJob::where('id_job', $identifier)->orWhere('jobname', $identifier)->firstOrFail();

        return view('lowongan.form_apply', compact('user','apply'));
    }

    public function apply(Request $request, $identifier)
    {
        // Validate the request inputs
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:15|regex:/^[0-9\s\+\-()]*$/',
            'linkedin' => 'nullable|url|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'coverletter' => 'nullable|string|max:1000',
        ], [
            'name.regex' => 'The name field must contain only letters and spaces.',
            'phone.regex' => 'The phone field must contain only numbers, spaces, and the following characters: + - ( )',
        ]);

        // Find the job based on identifier (ID or jobname)
        $job = ApplicantJob::where('id_job', $identifier)->orWhere('jobname', $identifier)->firstOrFail();

        // Check if there's an existing application for this job by the current user
        $existingApplication = FormJob::where('user_id', auth()->id())
            ->where('jobname', $job->jobname)
            ->first();

        // If there's an existing application that is pending (status == null), show a message
        if ($existingApplication && $existingApplication->status === 'Menunggu Tanggapan') {
            return redirect()->back()->with('error', 'Anda telah melamar pekerjaan ini dan sedang menunggu peninjauan.');
        }

        // Otherwise, create a new application
        $application = new FormJob();
        $application->user_id = auth()->id();
        $application->jobname = $job->jobname;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->phone = $request->phone;
        $application->linkedin = $request->linkedin;
        $application->coverletter = $request->coverletter;

        // Handle file upload if a resume is uploaded
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = time() . '.' . $resume->getClientOriginalExtension();
            $resume->move(public_path('resumes'), $resumeName);
            $application->resume = $resumeName;
        }

        // Save the application data to the database
        $application->save();

        return redirect('/job-thank-you')->with('success', 'Lamaran berhasil dikirimkan!');
    }
}
