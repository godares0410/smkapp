<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Asal Sekolah</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>WA</th>
            <th>Bawaan</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 1; @endphp
        @foreach ($pendaftar as $data)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $data->nama_pendaftar }}</td>
                <td>{{ $data->asal_sekolah }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->no_wa }}</td>
                <td>{{ $data->guru }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
