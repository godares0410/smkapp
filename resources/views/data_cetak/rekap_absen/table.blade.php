<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>S</th>
            <th>I</th>
            <th>A</th>
        </tr>
    </thead>
    <tbody>
    @php
    $counter = 1;
@endphp
@foreach ($siswa as $data)
    @php
        $alpa = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'A')->count();
        $sakit = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'S')->count();
        $ijin = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->where('keterangan', 'I')->count();
        $harialpa = floor($alpa / 8);
        $jamalpa = $alpa % 8;
        $harisakit = floor($sakit / 8);
        $jamsakit = $sakit % 8;
        $hariijin = floor($ijin / 8);
        $jamijin = $ijin % 8;
    @endphp
    <tr>
        <td>{{ $counter++ }}</td>
        <td>{{ $data->nama_siswa }}</td>
        <td>
            @if ($harisakit != 0)
                {{ $harisakit }} Hari
            @endif
            @if ($jamsakit != 0)
                @if ($harisakit != 0), @endif
                {{ $jamsakit }} Jam
            @endif
        </td>
        <td>
            @if ($hariijin != 0)
                {{ $hariijin }} Hari
            @endif
            @if ($jamijin != 0)
                @if ($hariijin != 0), @endif
                {{ $jamijin }} Jam
            @endif
        </td>
        <td>
            @if ($harialpa != 0)
                {{ $harialpa }} Hari
            @endif
            @if ($jamalpa != 0)
                @if ($harialpa != 0), @endif
                {{ $jamalpa }} Jam
            @endif
        </td>
    </tr>
@endforeach


    </tbody>
</table>
