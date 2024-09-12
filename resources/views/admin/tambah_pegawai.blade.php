@extends('layouts.back.app')

@section('title', 'Admin - Tambah Pegawai')

@section('content')
    @include('sweetalert::alert')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Form Pegawai</a></li>
                    <li class="breadcrumb-item active"><a href="{{ url('/admin/home') }}">Beranda</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Data Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home"><i
                                                class="far fa-user mr-2"></i> Data Pribadi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#profile"><i
                                                class="fas fa-briefcase mr-2"></i> Kepegawaian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#payrol"><i
                                                class="fas fa-wallet mr-2"></i> Payroll</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#message"><i
                                                class="fas fa-key mr-2"></i></i>
                                            Akun</a>
                                    </li>
                                </ul>
                                <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>NIK KTP <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="nik"
                                                                placeholder="Masukkan NIK KTP" value="{{ old('nik') }}">
                                                            @error('nik')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Nama lengkap <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="nama"
                                                                placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                                                            @error('nama')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tempat lahir <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="tempat_lahir"
                                                                placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
                                                            @error('tempat_lahir')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tanggal lahir <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}">
                                                            @error('tgl_lahir')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Jenis kelamin <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="jenis_kelamin">
                                                                <option hidden value="{{ old('jenis_kelamin') }}">Silahkan pilih</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                            @error('jenis_kelamin')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Agama <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="agama">
                                                                <option hidden value="{{ old('agama') }}">Silahkan pilih</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Katholik">Katholik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Budha">Budha</option>
                                                                <option value="Konghucu">Konghucu</option>
                                                            </select>
                                                        </div>
                                                        @error('agama')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label>Alamat <small class="text-danger">*</small></label>
                                                        <textarea name="alamat" class="form-control" value="{{ old('alamat') }}"></textarea>
                                                        @error('alamat')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label>Provinsi <small class="text-danger">*</small></label>
                                                        <select class="form-control" name="provinsi" id="id_provinsi">
                                                            <option hidden value="{{ old('provinsi') }}">Silahkan pilih</option>
                                                            @foreach ($prov as $row)
                                                                <option value="{{ $row->provinsi }}">
                                                                    {{ $row->provinsi }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('provinsi')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label>Kabupaten <small class="text-danger">*</small></label>
                                                        <select class="form-control" name="kabupaten" id="id_kabupaten">
                                                            <option hidden value="{{ old('kabupaten') }}">Silahkan pilih</option>
                                                            @foreach ($kab as $row)
                                                                <option value="{{ $row->kabupaten }}">
                                                                    {{ $row->kabupaten }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kabupaten')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label>Kecamatan <small class="text-danger">*</small></label>
                                                        <select class="form-control" name="kecamatan" id="id_kecamatan">
                                                            <option hidden value="{{ old('kecamatan') }}">Silahkan pilih</option>
                                                            @foreach ($kecamatan as $row)
                                                                <option value="{{ $row->kecamatan }}">
                                                                    {{ $row->kecamatan }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kecamatan')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Status pernikahan <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="status_nikah">
                                                                <option hidden value="{{ old('status_nikah') }}">Silahkan pilih</option>
                                                                <option value="Belum Kawin">Belum Kawin</option>
                                                                <option value="Sudah Kawin">Sudah Kawin</option>
                                                                <option value="Cerai Mati">Cerai Mati</option>
                                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                            </select>
                                                            @error('status_nikah')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Kewarganegaraan <small
                                                                    class="text-danger">*</small></label>
                                                            <select class="form-control" name="warga_negara">
                                                                <option hidden value="{{ old('warga_negara') }}">Silahkan pilih</option>
                                                                <option value="WNI">WNI</option>
                                                                <option value="WNA">WNA</option>
                                                                <option value="Naturalisasi">Naturalisasi</option>
                                                            </select>
                                                            @error('warga_negara')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Profile photo <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="file" class="form-control" name="photo" value="{{ old('photo') }}">
                                                            @error('photo')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Status <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="status_pegawai">
                                                                <option hidden>Silahkan pilih</option>
                                                                <option value="permanent employee">karyawan tetap
                                                                </option>
                                                                <option value="contract employee">karyawan kontrak
                                                                </option>
                                                                <option value="probationary employee">karyawan masa percobaan
                                                                </option>
                                                            </select>
                                                            @error('status_pegawai')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tanggal bergabung <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="date" class="form-control" name="tgl_masuk"
                                                                value="{{ date('Y-m-d') }}">
                                                            @error('tgl_masuk')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Bagian <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="id_bagian">
                                                                <option hidden>Silahkan pilih</option>
                                                                @foreach ($bagian as $row)
                                                                    <option value="{{ $row->id_bagian }}">
                                                                        {{ $row->nama_bagian }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_bagian')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Jabatan <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="id_jabatan"
                                                                id="id_jabatan">
                                                                <option hidden>Silahkan pilih</option>
                                                                @foreach ($jabatan as $row)
                                                                    <option value="{{ $row->id_jabatan }}">
                                                                        {{ $row->nama_jabatan }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_jabatan')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Gaji Pokok</label>
                                                            <input type="text" name="gaji_pokok" id="gaji_pokok"
                                                                class="form-control" value="{{ old('gaji_pokok') }}" readonly>
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Tunjangan</label>
                                                            <input type="text" name="tunjangan" id="tunjangan"
                                                                class="form-control" value="{{ old('tunjangan') }}" readonly>
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>BPJS <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="bpjs">
                                                                <option hidden>Silahkan pilih</option>
                                                                <option>Ya</option>
                                                                <option>Tidak</option>
                                                            </select>
                                                            @error('bpjs')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Pajak <small class="text-danger">*</small></label>
                                                            <select class="form-control" name="pajak">
                                                                <option hidden>Silahkan pilih</option>
                                                                <option>Ya</option>
                                                                <option>Tidak</option>
                                                            </select>
                                                            @error('pajak')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Email <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="email"
                                                                placeholder="Masukkan email aktif" value="{{ old('email') }}">
                                                            @error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Nomor telp <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="no_hp"
                                                                placeholder="Masukkan nomor telp" value="{{ old('no_hp') }}">
                                                            @error('no_hp')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="payrol" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Nomor rekening <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="number" class="form-control" name="no_rek"
                                                                placeholder="Masukkan nomor rekening" value="{{ old('no_rek') }}">
                                                            @error('no_rek')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Nama akun rekening <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="form-control" name="nama_rek"
                                                                placeholder="Masukkan nama rekening" value="{{ old('nama_rek') }}">
                                                            @error('nama_rek')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-danger mt-2"><small
                                                        class="text-danger">*</small><small>Catatan
                                                        : digunakan untuk pengiriman gaji kepada rekening yang telah di
                                                        daftarkan pada field diatas.</small></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="message" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Username <small class="text-danger">*</small></label>
                                                        <input type="text" class="form-control" name="username"
                                                            placeholder="Masukkan username" value="{{ old('username') }}">
                                                        @error('username')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Password <small class="text-danger">*</small></label>
                                                            <input type="password" class="form-control" name="password"
                                                                placeholder="Masukkan password" value="{{ old('password') }}">
                                                            @error('password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6 mt-2">
                                                            <label>Confirm password <small class="text-danger">*</small></label>
                                                            <input type="password" class="form-control" name="password_confirmation" 
                                                                placeholder="Ulangi password" value="{{ old('password_confirmation') }}">
                                                            @error('password_confirmation')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-danger mt-2"><small
                                                        class="text-danger">*</small><small>Catatan
                                                        : digunakan untuk kebutuhan login pegawai agar dapat masuk ke
                                                        halaman dashboard.</small></p>
                                                <br>
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Submit
                                                    data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const idJabatanSelect = document.getElementById('id_jabatan');
            const gajiPokokInput = document.getElementById('gaji_pokok');
            const tunjanganInput = document.getElementsByName('tunjangan')[0];

            idJabatanSelect.addEventListener('change', function() {
                const idJabatan = idJabatanSelect.value;
                if (idJabatan) {
                    fetch(`{{ route('pegawai.getgajitunjangan') }}?id_jabatan=${idJabatan}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.text())
                        .then(text => {
                            // Remove BOM if present
                            const jsonText = text.replace(/^\uFEFF/, '');
                            return JSON.parse(jsonText);
                        })
                        .then(data => {
                            console.log(data);

                            if (data) {

                                gajiPokokInput.value = data.gaji_pokok;
                                tunjanganInput.value = data.tunjangan;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });
        });
    </script>


@endsection
