@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Data Scan Masuk</h1>
                <hr>
                @if($sm->isEmpty())
                    <p>Tidak ada data scan masuk hari ini.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Waktu Scan Masuk</th>
                                    <th>Foto Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sm as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                        <td>{{ $data->nama_kelas }}</td>
                                        <td>{{ $data->kode_jurusan }}</td>
                                        <td>{{ $data->msk->format('H:i:s') }}</td>
                                        <td><img src="{{ asset('img/siswa/' . $data->fotosis) }}" alt="Foto Siswa" style="max-height: 100px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection