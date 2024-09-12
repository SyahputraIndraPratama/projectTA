<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $histori = Application::where('user_id', auth()->id())->get();
        return view('frontend.history', compact('histori'));
    }

    public function verify($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'verified';
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application verified successfully.');
    }

    public function scheduleInterview($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'interview';
        $application->save();

        // Add logic to schedule the interview
        // For example, create a new interview schedule

        return redirect()->route('applications.index')->with('success', 'Interview scheduled successfully.');
    }

    public function accept($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'accepted';
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application accepted successfully.');
    }

    public function reject($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'rejected';
        $application->save();

        return redirect()->route('applications.index')->with('success', 'Application rejected successfully.');
    }
}
