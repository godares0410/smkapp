{{-- <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            @foreach ($mapel as $mpl)
                <input type="hidden" name="id_mapel" id="id_mapel" value="{{ $mpl->id_mapel }}">
                <th>{{ $mpl->nama_mapel }}</th>
            @endforeach
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
</table> --}}

<div class="box-body table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                @foreach ($mapel as $mpl)
                    <th>{{ $mpl->nama_mapel }}</th>
                @endforeach
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
                    @foreach ($mapel as $mpl)
                        @php
                            $found = false;
                        @endphp
                        @foreach ($nilai as $nilaiData)
                            @if ($nilaiData->id_siswa == $data->id_siswa && $nilaiData->idm == $mpl->id_mapel)
                                <td>
                                    {{ $nilaiData->nilai }}
                                </td>
                                @php
                                    $found = true;
                                    break; // Break the inner loop once found
                                @endphp
                            @endif
                        @endforeach

                        @if (!$found)
                            <td></td> <!-- Display an empty cell if no matching data found -->
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
