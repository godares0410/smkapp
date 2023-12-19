<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach ($siswa as $data)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $data->nama_siswa }}</td>
                {{-- @dd($nilai); --}}
                @foreach ($nilai as $nilaiData)
                    @if ($nilaiData->id_siswa == $data->id_siswa)
                        <td>
                            {{ $nilaiData->nilai }}
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
