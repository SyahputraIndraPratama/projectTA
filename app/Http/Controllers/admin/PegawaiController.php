<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Payroll;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;
use App\Models\Provinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class PegawaiController extends Controller
{

    // public function index()
    // {
    //     $data = Pegawai::with('jabatan')->get(); // Load data pegawai beserta data jabatan
    //     return view('admin.pegawai', compact('data'));
    // }

    public function index(Request $request)
    {
        // Mendapatkan tanggal saat ini
        $tanggal = $request->input('tanggal');

        // Membuat query dasar dengan relasi jabatan
        $query = Pegawai::with('jabatan');

        // Filter berdasarkan Tanggal (misalnya tanggal lahir)
        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('tanggal_lahir', $request->tanggal);
        }

        // Filter berdasarkan Jabatan
        if ($request->has('jabatan_id') && $request->jabatan_id) {
            $query->where('id_jabatan', $request->jabatan_id);
        }

        // Filter berdasarkan Gaji Pokok
        if ($request->has('gaji_pokok') && $request->gaji_pokok) {
            $query->where('gaji_pokok', '>=', $request->gaji_pokok);
        }

        // Filter berdasarkan Jenis Kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Dapatkan data yang sudah difilter
        $data = $query->get();

        // Dapatkan daftar jabatan untuk dropdown filter
        $jabatans = Jabatan::all();

        // Jika permintaan AJAX, kembalikan hanya bagian tabel
        if ($request->ajax()) {
            return view('admin.partials.pegawai_table', compact('data'));
        }

        // Kirim data pegawai dan jabatan ke view
        return view('admin.pegawai', compact('data',
            'jabatans'
        ));
    }

    public function store(Request $request)
    {
        // Validasi input dengan penanganan pesan error
        $request->validate([
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'agama' => 'required|string',
            'status_nikah' => 'required|string',
            'warga_negara' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_pegawai' => 'required|string',
            'tgl_masuk' => 'required|date',
            'id_bagian' => 'required',
            'id_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'bpjs' => 'required|string|max:255',
            'pajak' => 'required|string|max:255',
            'no_rek' => 'required|string|max:255',
            'nama_rek' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawai',
            'username' => 'required|string|max:255|unique:pegawai',
            'password' => 'required|string|min:8|confirmed',
        ], [
            // Custom error messages
            'nik.required' => 'NIK harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'jenis_kelamin.required' => 'Silahkan pilih jenis kelamin.',
            'alamat.required' => 'Alamat harus diisi.',
            'provinsi.required' => 'Silahkan pilih provinsi.',
            'kabupaten.required' => 'Silahkan pilih kabupaten.',
            'kecamatan.required' => 'Silahkan pilih kecamatan.',
            'agama.required' => 'Agama harus diisi.',
            'status_nikah.required' => 'Silahkan pilih status nikah.',
            'warga_negara.required' => 'Silahkan pilih warga negara.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Foto harus memiliki format: jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'status_pegawai.required' => 'Status pegawai harus diisi.',
            'tgl_masuk.required' => 'Tanggal masuk harus diisi.',
            'id_bagian.required' => 'Silahkan pilih bagian.',
            'id_jabatan.required' => 'Silahkan pilih jabatan.',
            'gaji_pokok.required' => 'Gaji pokok harus diisi.',
            'tunjangan.required' => 'Tunjangan harus diisi.',
            'bpjs.required' => 'Silahkan pilih BPJS.',
            'pajak.required' => 'Silahkan pilih pajak.',
            'no_rek.required' => 'Nomor rekening harus diisi.',
            'nama_rek.required' => 'Nama rekening harus diisi.',
            'no_hp.required' => 'Nomor telp harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password harus diisi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Persiapan data untuk disimpan
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'agama' => $request->agama,
            'status_nikah' => $request->status_nikah,
            'warga_negara' => $request->warga_negara,
            'status_pegawai' => $request->status_pegawai,
            'tgl_masuk' => $request->tgl_masuk,
            'id_bagian' => $request->id_bagian,
            'id_jabatan' => $request->id_jabatan,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'bpjs' => $request->bpjs,
            'pajak' => $request->pajak,
            'no_rek' => $request->no_rek,
            'nama_rek' => $request->nama_rek,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        // Jika ada file foto yang diupload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['photo'] = $filename;
        }

        // Menyimpan data pegawai ke database
        Pegawai::create($data);

        // Menampilkan pesan sukses
        Alert::success('Success', 'Data Berhasil ditambah', '1500');

        // Redirect ke halaman index pegawai
        return redirect()->route('pegawai.index');
    }

    public function getdatakabupaten(Request $request)
    {
        $kabupaten = Kabupaten::where('id_provinsi', $request->provinsi)->get();
        return response()->json($kabupaten);
    }

    public function getdatakecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $request->kabupaten)->get();
        return response()->json($kecamatan);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('admin.edit_pegawai', compact('pegawai'));
    }

    public function update(Request $request, $id_pegawai)
    {
        $request->validate([
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawai,email',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'status_nikah' => 'required|string',
            'warga_negara' => 'required|string',
            'no_rek' => 'required|string|max:255',
            'nama_rek' => 'required|string|max:255',
        ]);

        $pegawai = Pegawai::findOrFail($id_pegawai);
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->no_hp = $request->no_hp;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->agama = $request->agama;
        $pegawai->status_nikah = $request->status_nikah;
        $pegawai->warga_negara = $request->warga_negara;
        $pegawai->no_rek = $request->no_rek;
        $pegawai->nama_rek = $request->nama_rek;
        $pegawai->save();
        Alert::success('Success', 'Data Berhasil diupdate', '1500');
        return to_route('pegawai.index');
    }

    public function detail($id)
    {
        // Fetch employee details with related models
        $pegawai = Pegawai::with(['jabatan', 'bagian', 'kecamatan', 'kabupaten', 'provinsi'])->find($id);

        // Fetch all payroll details
        $pay = Payroll::all();

        // Calculate additional fields for payroll
        foreach ($pay as $p) {
            $p->alfa = $p->gaji_pokok / 26 * $p->alpha;
            $bruto_setahun = $p->gaji_pokok + $p->tunjangan * 12;
            $jabatan = 0.05 * $bruto_setahun;
            $netto = $bruto_setahun - $jabatan;
            $pkp = 54000000 - $netto;
            $lapis_pertama = 0.05 * 50000000;
            $p->pph = $lapis_pertama / 12;
            $p->total = $p->gaji_pokok + $p->tunjangan - $p->alfa - $p->pph;
        }

        // Return the view with employee and payroll data
        return view('admin.detail_pegawai', compact('pegawai', 'pay'));
    }

    public function destroy($id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);
        if ($pegawai) {
            $pegawai->delete();
            Alert::success('Success', 'Pegawai Berhasil dihapus', '1500');
            return redirect()->route('pegawai.index');
        } else {
            Alert::error('Error', 'Pegawai Tidak Dapat dihapus', '1500');
            return redirect()->route('pegawai.index');
        }
    }

    public function cetakPegawai(Request $request)
    {
        // Ambil tanggal dari input
        $tanggal = $request->input('tanggal');

        // Ambil data pegawai berdasarkan tanggal yang dipilih
        $data = Pegawai::with('jabatan')
        // ->whereDate('created_at', $tanggal)
            ->get();

        // Format tanggal untuk ditampilkan di view
        $formattedTanggal = Carbon::parse($tanggal)->translatedFormat('d F Y');

        // Mendapatkan tanggal saat ini dalam format YmdHis
        $tgl = date("YmdHis");

        // Meload view untuk mencetak data pegawai
        $pdf = PDF::loadView('admin.cetak_pegawai', compact('data', 'tanggal', 'formattedTanggal', 'tgl'))
        ->setPaper('a4', 'potrait');

        // Menampilkan file PDF di browser tanpa mendownload
        return $pdf->stream('data-pegawai-' . $tgl . '.pdf', ['Attachment' => false]);
    }
}
