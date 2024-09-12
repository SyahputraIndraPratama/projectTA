<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Payroll;
use App\Models\Pegawai;
use App\Models\SettingsGaji;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;

class PayrollController extends Controller
{
    public function home(Request $request)
    {
        $pages = 'pegawai';
        $month = date("m");
        $year = date("Y");
        $cari = $request->cari;

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        $datas = Payroll::whereMonth('tgl_payroll', $month)
            ->whereYear('tgl_payroll', $year)
            ->get();

        $getsettingsgaji = SettingsGaji::first();

        return view('keuangan.payroll', compact('datas', 'request', 'pages', 'cari'));
    }

    public function generate(Request $request)
    {
        $month = date("m");
        $year = date("Y");
        $cari = $request->cari;

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        $getsettingsgaji = SettingsGaji::first();
        $pegawais = Pegawai::get();
        foreach ($pegawais as $pegawai) {
            $periksa = Payroll::where('id_pegawai', $pegawai->id)
                ->whereMonth('tgl_payroll', $month)
                ->whereYear('tgl_payroll', $year)
                ->count();

            if ($periksa < 1) {
                if ($pegawai->bpjs == 'Ya') {
                    $bpjs = $getsettingsgaji->bpjs;
                } else {
                    $bpjs = 0;
                }
                if ($pegawai->pajak == 'Ya') {
                    $pajak = $getsettingsgaji->pajak;
                } else {
                    $pajak = 0;
                }

                // Generate kode payroll
                $kode_payroll = 'PR-' . Carbon::now()->format('YmdHis');

                // Simpan ke database
                Payroll::create([
                    'kode_payroll' => $kode_payroll,
                    'tgl_payroll' => Carbon::now(),
                    'waktu_payroll' => Carbon::now()->format('H:i:s'),
                    'id_pegawai' => $pegawai->id_pegawai,
                    'nama_jabatan' => $pegawai->jabatan->nama_jabatan,
                    'nama_bagian' => $pegawai->bagian->nama_bagian, // Pastikan relasi bagian ada di model Pegawai
                    'bpjs' => $bpjs,
                    'pajak' => $pajak,
                    'status' => 'belum', // Atur status sesuai dengan proses payroll
                    // 'channel_bayar' => 'Transfer', // Misalnya default menggunakan transfer
                    // 'qr_code' => '', // Pastikan diisi dengan QR Code yang sesuai
                    'tgl_generate' => Carbon::now()->format('Y-m-d'),
                ]);
            }
        }

        Alert::success('Success', 'Proses generate gaji berhasil!', '1500');
        return to_route('payroll.index');
    }

    public function cetak(Request $request, $id)
    {
        $month = date("m");
        $year = date("Y");
        $cari = $request->cari;

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        $datas = Payroll::with('pegawai')
            ->where('id_payroll', $id)
            ->whereMonth('tgl_payroll', $month)
            ->whereYear('tgl_payroll', $year)
            ->get();

        $getsettingsgaji = SettingsGaji::first();
        $tgl = date("YmdHis");

        $pdf = PDF::loadView('keuangan.payroll_slip', compact('datas', 'getsettingsgaji', 'tgl', 'year', 'month'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('ehrm' . $tgl . '.pdf', ['Attachment' => false]);
    }

    public function cetakrincian(Request $request)
    {
        $tgl = date("YmdHis");
        $month = date("m");
        $year = date("Y");
        $cari = $request->input('cari');

        if ($cari) {
            $month = date("m", strtotime($cari));
            $year = date("Y", strtotime($cari));
        }

        $datas = Payroll::with('pegawai')
            ->whereMonth('tgl_payroll', $month)
            ->whereYear('tgl_payroll', $year)
            ->get();

        $getsettingsgaji = SettingsGaji::first();

        $pdf = PDF::loadview('keuangan.payroll_slip_all', compact('datas', 'getsettingsgaji', 'tgl', 'year', 'month'))->setPaper('a4', 'landscape');

        return $pdf->stream('ehrm' . $tgl . 'pdf');
    }


    public function send($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->status = 'berhasil'; // atau status lain yang diinginkan
        $payroll->save();

        Alert::success('Success', 'Gaji berhasil dikirim', '1500');
        return redirect()->route('payroll.index');
    }

    public function tambah()
    {
        $pegawai = Pegawai::all();

        return view('keuangan.add_payroll', compact('pegawai'));
    }

    public function getJabatan(Request $request)
    {
        $id_jabatan = $request->input('id_jabatan');
        $jabatan = Jabatan::find($id_jabatan);

        if ($jabatan) {
            return response()->json([
                'nama_jabatan' => $jabatan->nama_jabatan,
                'gaji_pokok' => $jabatan->gaji_pokok,
                'tunjangan' => $jabatan->tunjangan,
            ]);
        }

        return response()->json();
    }

    public function getPegawai(Request $request)
    {
        $id_pegawai = $request->input('id_pegawai');
        $pegawai = Pegawai::with('bagian', 'jabatan')->find($id_pegawai);

        if ($pegawai) {
            return response()->json([
                'no_rek' => $pegawai->no_rek,
                'nama_rek' => $pegawai->nama_rek,
                'nama_bagian' => $pegawai->bagian->nama_bagian,
                'nama_jabatan' => $pegawai->jabatan->nama_jabatan,
                'gaji_pokok' => $pegawai->jabatan->gaji_pokok,
                'tunjangan' => $pegawai->jabatan->tunjangan,
                'amount' => $pegawai->gaji_pokok + $pegawai->tunjangan,
            ]);
        }

        return response()->json();
    }

    public function simpan(Request $request)
    {

        // Generate QR code
        $payrollCode = $request->kode_payroll;
        $qrCode = new QrCode($payrollCode);
        $writer = new PngWriter();
        $qrCodeResult = $writer->write($qrCode);

        // Tentukan path penyimpanan
        $qrCodeFileName = $payrollCode . '.png';
        $qrCodePath = 'admin/qr_code/' . $qrCodeFileName;

        // Simpan QR code ke storage
        Storage::disk('public')->put($qrCodePath, $qrCodeResult->getString());

        // Simpan data ke database
        $data = [
            'kode_payroll' => $request->kode_payroll,
            'tgl_payroll' => $request->tgl_payroll,
            'waktu_payroll' => $request->waktu_payroll,
            'id_pegawai' => $request->id_pegawai,
            'nama_jabatan' => $request->nama_jabatan,
            'nama_bagian' => $request->nama_bagian,
            'hadir' => $request->hadir,
            'sakit' => $request->sakit,
            'alpha' => $request->alpha,
            'telat' => $request->telat,
            'bpjs' => $request->bpjs,
            'pajak' => $request->pajak,
            'status' => $request->status,
            'channel_bayar' => $request->channel_bayar,
            'qr_code' => $qrCodeFileName, // Simpan nama file QR code
        ];

        // Simpan data ke database
        Payroll::create($data);

        // Redirect ke halaman lain setelah menyimpan data
        Alert::success('Success', 'Data Berhasil ditambah', '1500');
        return to_route('payroll.index');
    }

    public function payslip($id)
    {
        // Fetch the payroll data based on $id
        $slip = Payroll::findOrFail($id);

        // Fetch additional data from related tables
        $pegawai = Pegawai::findOrFail($slip->id_pegawai); // Adjust according to your actual relationship
        $jabatan = Jabatan::findOrFail($pegawai->id_jabatan); // Adjust according to your actual relationship

        // Assuming your view is named 'payroll_slip.blade.php' and located in 'resources/views/admin'
        return view('keuangan.payroll_slip', compact('slip', 'pegawai', 'jabatan'));
    }

    public function delete($id)
    {
        $datas = Payroll::findOrFail($id);
        $datas->delete();

        Alert::success('Success', 'Data Berhasil ditambah', '1500');
        return to_route('payroll.index');
    }
}
