<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Models\ApplicantJob;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class JobController extends Controller
{
    public function index()
    {
        // $currentDate = now()->toDateString();

        // Mengambil semua pekerjaan
        //$allJobs = ApplicantJob::all();

        // // Update status pekerjaan berdasarkan tanggal berakhir
        // foreach ($allJobs as $job) {
        //     if ($job->close_date >= $currentDate) {
        //         $job->status = 'Active';
        //     } else {
        //         $job->status = 'Inactive';
        //     }
        //     $job->save(); // Simpan perubahan status
        // }

        // Setelah update status, pisahkan pekerjaan menjadi active dan inactive
        $activeJobs = ApplicantJob::where('status', 'Active')->get();
        $inactiveJobs = ApplicantJob::where('status', 'Inactive')->get();

        return view('hrd.kelola_job', compact('activeJobs', 'inactiveJobs'));
    }

    public function create()
    {
        return view('hrd.kelola_job');
    }

    public function store(Request $request)
    {
        // Validate and store the new job
        $request->validate([
            'jobname' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'requirement' => 'required|string',
            'img' => 'nullable|image',
            'tgl_posting' => 'required|date_format:Y-m-d\TH:i',
            'close_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isPast()) {
                        $fail('Tanggal berakhir tidak boleh tanggal yang sudah lewat');
                    }
                },
            ],
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'tipe_pekerjaan' => 'required|string',
            'durasi' => 'required|string',
            'salary' => 'nullable|numeric',
        ]);

        $job = new ApplicantJob();
        $job->jobname = $request->jobname;
        $job->deskripsi = $request->deskripsi;

        // Proses input kualifikasi menjadi format vertikal tanpa penomoran
        $requirement = explode("\n", trim($request->requirement));
        $formattedRequirement = '';
        foreach ($requirement as $req) {
            $formattedRequirement .= $req . "\n";
        }
        $job->requirement = trim($formattedRequirement);
        $job->tgl_posting = \Carbon\Carbon::parse($request->tgl_posting)->setTimezone('Asia/Jakarta');
        $job->close_date = $request->close_date;
        $job->company_name = $request->company_name;
        $job->location = $request->location;
        $job->tipe_pekerjaan = $request->tipe_pekerjaan;
        $job->durasi = $request->durasi;
        $job->salary = $request->salary;
        $job->status = 'Active';

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $job->img = $filename;
        }

        $job->save();
        Alert::success('Success', 'Job Berhasil ditambahkan', '1500');
        return redirect()->route('jobs.index');
    }

    public function edit(ApplicantJob $job)
    {
        return view('hrd.kelola_job', compact('job'));
    }

    public function update(Request $request, ApplicantJob $job)
    {
        // Validate the job input data
        $request->validate([
            'jobname' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'requirement' => 'required|string',
            'tgl_posting' => 'required|date',
            'close_date' => 'required|date',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'durasi' => 'required|string',
            'tipe_pekerjaan' => 'required|string',
            'salary' => 'nullable|numeric',
        ]);

        // Update job attributes
        $job->jobname = $request->jobname;
        $job->deskripsi = $request->deskripsi;
        $requirement = explode("\n", trim($request->requirement));
        $formattedRequirement = '';
        foreach ($requirement as $req) {
            $formattedRequirement .= $req . "\n";
        }
        $job->requirement = trim($formattedRequirement);
        $job->tgl_posting = $request->tgl_posting;
        $job->close_date = $request->close_date;
        $job->company_name = $request->company_name;
        $job->location = $request->location;
        $job->tipe_pekerjaan = $request->tipe_pekerjaan;
        $job->durasi = $request->durasi;
        $job->salary = $request->salary;

        // Handle file upload if an image is provided
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $job->img = 'uploads/' . $filename;
        }
        
        // Save the updated job
        $job->save();
        Alert::success('Success', 'Job Berhasil diupdate', '1500');
        return redirect()->route('jobs.index');

        // // Check and update the job status based on close_date
        // $currentDate = Carbon::now()->toDateString();
        // if ($job->close_date >= $currentDate) {
        //     $job->status = 'Active';
        // } else {
        //     $job->status = 'Inactive';
        // }
        
    }

    public function destroy(ApplicantJob $job)
    {
        if ($job->img) {
            unlink(public_path('uploads/' . $job->img));
        }

        $job->delete();
        Alert::success('Success', 'Job Berhasil dihapus', '1500');
        return redirect()->route('jobs.index');
    }
}
