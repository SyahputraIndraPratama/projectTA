 $(document).ready(function() {
        // Handle edit button click
        $('.edit-provinsi').click(function() {
            var id = $(this).data('id');
            var provinsi = $(this).data('provinsi');
            $('#editIdProvinsi').val(id);
            $('#editNamaProvinsi').val(provinsi);
            $('#editProvinsiForm').attr('action', '/admin/provinsi/update/' + id);
        });

        // Handle delete button click
        $('.delete-provinsi').click(function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus data provinsi ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteProvinsiForm').attr('action', '/admin/provinsi/hapus/' + id)
                        .submit();
            }
        });
    });
});

$(document).ready(function() {
    // Handle edit button click
    $('.edit-kabupaten').click(function() {
        var id = $(this).data('id');
        var idProvinsi = $(this).data('id_provinsi');
        var kabupaten = $(this).data('kabupaten');

        $('#editIdKabupaten').val(id);
        $('#editIdProvinsi').val(idProvinsi);
        $('#editNamaKabupaten').val(kabupaten);

        $('#editKabupatenForm').attr('action', '/admin/kabupaten/update/' + id);
    });

        $('.edit-kabupaten').click(function() {
            var id = $(this).data('id');
            var idProvinsi = $(this).data('id_provinsi');
            var kabupaten = $(this).data('kabupaten');

            $('#editIdKabupaten').val(id);
            $('#editIdProvinsi').val(idProvinsi);
            $('#editNamaKabupaten').val(kabupaten);

            $('#editKabupatenForm').attr('action', '/admin/kabupaten/update/' + id);
        });


        // Handle modal close event
        $('#editKabupaten').on('hidden.bs.modal', function() {
            $('#editIdKabupaten').val('');
            $('#editIdProvinsi').val('');
            $('#editNamaKabupaten').val('');
        });
            // Handle delete button click with SweetAlert
            $('.delete-kabupaten').click(function() {
                var id = $(this).data('id');

                Swal.fire({
                title: 'Yakin ingin menghapus data kabupaten ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
        }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteKabupatenForm').attr('action', '/admin/kabupaten/hapus/' + id)
                        .submit();
            }
        });
    });
});

$(document).ready(function() {
        // Handle edit button click
        $('.edit-kecamatan').click(function() {
            var id = $(this).data('id');
            var idKabupaten = $(this).data('id_kabupaten');
            var kecamatan = $(this).data('kecamatan');

            $('#editIdKecamatan').val(id);
            $('#editIdKabupaten').val(idKabupaten);
            $('#editNamaKecamatan').val(kecamatan);

            $('#editKecamatanForm').attr('action', '/admin/kecamatan/update/' + id);
        });

            // Handle modal close event
            $('#editKecamatan').on('hidden.bs.modal', function() {
            $('#editIdKecamatan').val('');
            $('#editIdKabupaten').val('');
            $('#editNamaKecamatan').val('');
        });

        // Handle delete button click with SweetAlert
        $('.delete-kecamatan').click(function() {
            var id = $(this).data('id');

            Swal.fire({
            title: 'Yakin ingin menghapus data kecamatan ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteKecamatanForm').attr('action', '/admin/kecamatan/hapus/' + id)
                    .submit();
            }
        });
    });
});

$(document).ready(function() {
            // Handle edit button click
            $('.edit-jabatan').click(function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var gaji = $(this).data('gaji');
                var tunjangan = $(this).data('tunjangan');

                $('#editIdJabatan').val(id);
                $('#editNamaJabatan').val(nama);
                $('#editGajiPokok').val(gaji);
                $('#editTunjangan').val(tunjangan);

                var actionUrl = "/admin/jabatan/update/" + id;
                $('#editJabatanForm').attr('action', actionUrl);
            });

            // Handle delete button click with SweetAlert
            $('.delete-jabatan').click(function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus data jabatan ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteJabatanForm').attr('action', '/admin/jabatan/hapus/' + id)
                            .submit();
                    }
                });
            });
        });

         $(document).ready(function() {
            // Handle edit button click
            $('.edit-bagian').click(function() {
                var id = $(this).data('id');
                var bagian = $(this).data('bagian');
                $('#editIdBagian').val(id);
                $('#editNamaBagian').val(bagian);
                $('#editBagianForm').attr('action', '/admin/bagian/update/' + id);
            });

            $('.delete-bagian').click(function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus data bagian ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteBagianForm').attr('action', '/admin/bagian/hapus/' + id)
                            .submit();
                    }
                });
            });
        });

        $(document).ready(function() {
            // Handle edit button click
            $('.edit-pegawai').click(function() {
                var id = $(this).data('id');
                var nik = $(this).data('nik');
                var nama = $(this).data('nama');
                var email = $(this).data('email');
                var no_hp = $(this).data('no_hp');
                var tempat_lahir = $(this).data('tempat_lahir');
                var tgl_lahir = $(this).data('tgl_lahir');
                var jenis_kelamin = $(this).data('jenis_kelamin');
                var agama = $(this).data('agama');
                var status_nikah = $(this).data('status_nikah');
                var no_rek = $(this).data('no_rek');
                var nama_rek = $(this).data('nama_rek');
                $('#editIdBagian').val(id);
                $('#editNikBagian').val(nik);
                $('#editNamaPegawai').val(nama);
                $('#editEmailPegawai').val(email);
                $('#editNumberPegawai').val(no_hp);
                $('#editTempatLahirPegawai').val(tempat_lahir);
                $('#editTanggalLahirPegawai').val(tgl_lahir);
                $('#editJenisKelaminPegawai').val(jenis_kelamin);
                $('#editAgamaPegawai').val(agama);
                $('#editStatusPegawai').val(status_nikah);
                $('#editWargaNegaraPegawai').val(warga_negara);
                $('#editNoRekPegawai').val(no_rek);
                $('#editNamaRekPegawai').val(nama_rek);
                $('#editPegawaiForm').attr('action', '/admin/pegawai/update/' + id);
            });

            $('.delete-pegawai').click(function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus data pegawai ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deletePegawaiForm').attr('action', '/admin/pegawai/hapus/' + id)
                            .submit();
                    }
                });
            });
        });