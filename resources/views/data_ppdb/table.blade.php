<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 20px">N0</th>
            <th>Nama Pendaftar</th>
            <th>Asal Sekolah</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>WA</th>
            <th>Bawaan</th>
            <th class="text-center">Detail</th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach ($pendaftar as $data)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $data->nama_pendaftar }}</td>
                <td>{{ $data->asal_sekolah }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->no_wa }}</td>
                <td>{{ $data->guru }}</td>
                <td>
                    <div class="row">
                        <div class="col-md-6 mb-2 text-center">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#modalDetail{{ $data->id_pendaftar }}" style="margin-bottom: 5px;">
                                Detail
                            </button>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('daftar.destroy', $data->id_pendaftar) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
