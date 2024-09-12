@extends('keuangan.app')

@section('title', 'Keuangan - Add Payroll')

@section('content')
    <style>
        .custom-input-group .input-group-text,
        .custom-input-group select.form-control {
            height: calc(2.25rem + 2px);
            /* Sesuaikan dengan tinggi elemen form */
            line-height: 1.5;
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
        }

        .custom-input-group .input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Payroll</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-black">
                    <a>Payroll</a> / <a href="/admin/home">Home</a>
                </h6>
            </div>
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-7 order-md-1">
                                        <h4 class="mb-3">Perhitungan gaji</h4>
                                        <hr>
                                        <br>
                                        <form action="{{ route('payroll.simpan') }}" method="post" class="needs-validation"
                                            novalidate="">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstName">Payment date</label>
                                                    <input type="hidden" class="form-control" name="kode_payroll"
                                                        value="TR{{ mt_rand(100000000000, 999999999999) }}" maxlength="30">
                                                    <input type="date" class="form-control" name="tgl_payroll"
                                                        id="firstName" value="{{ date('Y-m-d') }}"="">
                                                    <div class="invalid-feedback">
                                                        Valid first name is .
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastName">Payment time</label>
                                                    <input type="time" class="form-control" id="lastName"
                                                        name="waktu_payroll" placeholder="" value="{{ date('H:i') }}"="">
                                                    <div class="invalid-feedback">
                                                        Valid last name is .
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="username">Pegawai</label>
                                                <div class="input-group custom-input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa-solid fa-user-group"></i>
                                                        </span>
                                                    </div>
                                                    <select name="id_pegawai" id="id_pegawai" class="form-control">
                                                        <option hidden>Silahkan pilih</option>
                                                        @foreach ($pegawai as $p)
                                                            <option value="{{ $p->id_pegawai }}">{{ $p->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Work division</label>
                                                <input type="text" name="nama_bagian" class="form-control" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label>Position</label>
                                                <input type="text" name="nama_jabatan" class="form-control" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Salary</label>
                                                    <input type="text" name="gaji_pokok" id="gaji_pokok"
                                                        class="form-control" readonly>
                                                </div>
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Allowance</label>
                                                    <input type="hidden" name="amount" class="form-control" readonly>
                                                    <input type="text" name="tunjangan" id="tunjangan"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>BPJS</label>
                                                    <input type="text" name="bpjs" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Pajak Penghasilan</label>
                                                    <input type="text" name="pajak" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Total</label>
                                                    <input type="text" name="total_payroll" class="form-control">
                                                </div>
                                            </div>
                                            <hr class="mb-4">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Name on card</label>
                                                    <input type="text" name="nama_rek" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label>Credit card number</label>
                                                    <input type="text" name="no_rek" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="username">Payment Method</label>
                                                <input type="text" name="method_payment" value="Direct bank transfer"
                                                    class="form-control">
                                            </div>

                                            <hr class="mb-4">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to
                                                checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
