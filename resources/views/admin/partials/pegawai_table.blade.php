<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Gaji Pokok</th>
            <th>Tunjangan</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php($no = 1)
        @foreach ($data as $row)
            <tr>
                <td class="py-3">{{ $no++ }}</td>
                <td class="py-3">
                    <div class="media d-flex align-items-center">
                        <div class="avatar avatar-xl mr-2">
                            @if ($row->photo)
                                <img class="rounded-circle img-fluid"
                                    src="{{ url('uploads/' . $row->photo) }}" width="30"
                                    alt="{{ $row->nama }}">
                            @else
                                <img class="rounded-circle img-fluid"
                                    src="{{ url('uploads/default.png') }}" width="30"
                                    alt="Default Image">
                            @endif
                        </div>&nbsp;
                        <div class="media-body">
                            <p class="mb-0">{{ $row->nama }}</p>
                        </div>
                    </div>
                </td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->jabatan->nama_jabatan ?? 'Tidak Ada' }}</td>
                <td>{{ formatrupiah($row->gaji_pokok) }}</td>
                <td>{{ formatrupiah($row->tunjangan) }}</td>
                <td>{{ $row->no_hp }}</td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ route('detail.edit', $row->id_pegawai) }}"
                            class="btn btn-success mb-2 edit-pegawai">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('pegawai.edit', $row->id_pegawai) }}"
                            class="btn btn-warning mb-2 edit-pegawai">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger delete-pegawai"
                            data-id="{{ $row->id_pegawai }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
