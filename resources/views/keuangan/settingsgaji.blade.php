@extends('keuangan.app')

@section('title', 'Keuangan - Setting Gaji')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengaturan</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Potongan Gaji</a> / <a href="/keuangan/home">Beranda</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="content-body">
                    <!-- row -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12 col-xxl-12 col-lg-12">
                                <div class="card-body">
                                    @push('before-script')
                                        <script>
                                            $(function() {
                                                let transport = document.getElementById('transport');
                                                transport.addEventListener('keyup', function(e) {
                                                    transport.value = babengRupiah(this.value, 'Rp. ');
                                                });
                                                let simkoperasi = document.getElementById('simkoperasi');
                                                simkoperasi.addEventListener('keyup', function(e) {
                                                    simkoperasi.value = babengRupiah(this.value, 'Rp. ');
                                                });
                                                let dansos = document.getElementById('dansos');
                                                dansos.addEventListener('keyup', function(e) {
                                                    dansos.value = babengRupiah(this.value, 'Rp. ');
                                                });
                                                let walikelas = document.getElementById('walikelas');
                                                walikelas.addEventListener('keyup', function(e) {
                                                    walikelas.value = babengRupiah(this.value, 'Rp. ');
                                                });
                                                let gajipokok = document.getElementById('gajipokok');
                                                gajipokok.addEventListener('keyup', function(e) {
                                                    gajipokok.value = babengRupiah(this.value, 'Rp. ');
                                                });
                                            });
                                        </script>
                                        <script src="{{ asset('/js/babeng.js') }}"></script>
                                    @endpush
                                    <form action="{{ route('settingsgaji.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">BPJS<span
                                                    class="required" style="color: red">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control mt-3" name="bpjs" id="bpjs"
                                                    required="required" value="{{ old('bpjs', $settings->bpjs ?? '') }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Pajak<span
                                                    class="required" style="color: red">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control mt-3" name="pajak" id="pajak"
                                                    type="text" required="required"
                                                    value="{{ old('pajak', $settings->pajak ?? '') }}" />
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-3 mt-3">
                                                    <button type='submit' class="btn btn-primary">Simpan</button>
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
    </div>
@endsection
