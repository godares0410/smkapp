@extends('layout.master')

@section('title')
    Absen
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('struktur', 'active')
@section('struktur-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords($title) }}</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500 // Menutup pesan dalam 1 detik (1000ms)
                });
            </script>
        @endif



        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data {{ ucwords($title) }}</h3>
            </div>
                <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">NO</th>
                            <th>Nama</th>
                            <th class="text-center">Detail</th>
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
                                @php
                                $today = \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                    $siswaAbsen = \App\Models\SiswaAbsen::where('id_siswa', $data->id_siswa)->whereDate('tanggal', $today)->select('keterangan', 'jam_ke')->first();
                                @endphp

                                <td class="text-center">
    @if ($siswaAbsen)
        @php
            $keteranganLabels = [
                'A' => 'Alpa',
                'S' => 'Sakit',
                'I' => 'Ijin',
            ];

            $keterangan = $siswaAbsen->keterangan ?? '';
            $label = $keteranganLabels[$keterangan] ?? '';
        @endphp

        @php
            $ketArray = [];
        @endphp

        @foreach ($absen as $abs)
            @if ($abs->id_siswa == $data->id_siswa)
                @php
                    $ketArray[] = $abs->jam_ke;
                @endphp
            @endif
        @endforeach

        @if ($keterangan)
            @if (count($ketArray) == 8)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAbsen{{ $data->id_siswa }}">
                    {{ $label }} (Sehari)
                </button>
            @else
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAbsen{{ $data->id_siswa }}">
                    {{ $label }} Jam ke: ({{ implode(', ', $ketArray) }})
                </button>
            @endif
        @endif
    @else
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAbsen{{ $data->id_siswa }}">
            Hadir
        </button>
    @endif
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('siswa.absen.modal')
@endsection


@push('script')
    <script>
            $(document).ready(function() {
            $('.table').DataTable()
        });

 $(document).ready(function() {
            // ...

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
                // ...
            }
            
        });
    </script>

    <script>
    $(document).ready(function() {
        // Mengatur perilaku checkbox "Jam" berdasarkan checkbox "Sehari"
        $('.sehari').change(function() {
            if ($(this).prop('checked')) {
                // Jika "Sehari" tercentang, cek semua checkbox "Jam"
                $('input[name="jam[]"]').prop('checked', true);
            } else {
                // Jika "Sehari" tidak tercentang, hapus cek pada semua checkbox "Jam"
                $('input[name="jam[]"]').prop('checked', false);
            }
        });
    });
</script>
@endpush
