@extends('layout.master')

@section('title')
    jadwal Ujian
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ujian', 'active')
@section('jadwal_ujian-active', 'active')

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
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahJenis">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <!-- /.col -->
                <div class="box-body">
                    @foreach ($jadwal as $data)
                        <div class="col-md-6 col-lg-4">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $data->nama_mapel }} - {{ $data->nama_kelas }}
                                    </h3>

                                    <div class="box-tools pull-right">
                                        <form action="{{ route('jadwal_ujian.destroy', $data->id_jadwal_ujian) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete btn btn-box-tool"><i
                                                    class="fa fa-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="overflow: hidden; max-height: 140px;"
                                    onmouseover="this.style.overflow='scroll'" onmouseout="this.style.overflow='hidden'">
                                    <table class="table-striped" style="width: 100%">
                                        <tr>
                                            <th>Jurusan</th>
                                            <th>:</th>
                                            @php
                                                $decodedIdJurusanValues = json_decode($data->id_jurusan, true);

                                                // Check if $decodedIdJurusanValues is not null before using it
                                                if (!is_null($decodedIdJurusanValues)) {
                                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                                        ->pluck('kode_jurusan')
                                                        ->toArray();
                                                } else {
                                                    // Handle the case when $decodedIdJurusanValues is null
                                                    $matchingKodeJurusanValues = [];
                                                }
                                            @endphp
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(0, 152, 134)">
                                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                                        {{ $kodeJurusan }}

                                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Mulai</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(0, 58, 152)">{{ $data->tgl_mulai }}</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Selesai</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(233, 53, 8)">{{ $data->tgl_selesai }}</span>
                                            </th>
                                        </tr>
                                        {{-- <tr>
                                            <th>Jam</th>
                                            <th>:</th>

                                            <th class="text-right"><span class="label label-success">3</span>
                                                - <span class="label label-danger">6</span></th>
                                        </tr> --}}
                                        <tr>
                                            <th>Durasi</th>
                                            <th>:</th>
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(207, 135, 0)">{{ $data->durasi }}
                                                    Menit</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Soal</th>
                                            <th>:</th>
                                            <th class="text-right"><span class="label"
                                                    style="background-color: rgb(150, 32, 130)">{{ $data->jumlah_soal }}</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Sesi</th>
                                            <th>:</th>
                                            <th class="text-right">
                                                @foreach ($sesiUjian as $ssi)
                                                    @if ($ssi->id_jadwal_ujian == $data->id_jadwal_ujian)
                                                        <span class="label"
                                                            style="background-color: rgb(0, 168, 240)">{{ $ssi->nama_sesi }}
                                                            ({{ $ssi->jam_mulai }} - {{ $ssi->jam_selesai }})</span><br>
                                                    @endif
                                                @endforeach
                                            </th>
                                        </tr>
                                    </table>
                                    {{-- <div class="box col-md-3 col-lg-2">
                                    20-1-2023
                                    </div> --}}
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        </div>
    </section>
    @includeIf('data_ujian.jadwal_ujian.modul')
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5-0.3.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable()
        })

        $(document).ready(function() {
            // ...

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
                // ...
            }

            // Menangkap event tombol dengan atribut data-target="#modalTambahjurusan"
            $('button[data-target="#modalTambahBankSoal"]').on('click', function() {
                var title = "Tambah Jurusan";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportJurusan"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Jurusan";
                openModal(title);
            });
        });
    </script>

    <!-- Updated JavaScript code -->
    <script>
        $(document).ready(function() {
            // Show/hide and check/uncheck checkboxes for jam_ke based on sesi checkbox status
            $('.sesi-checkbox').change(function() {
                var sesiId = $(this).data('sesi');
                var jamKeContainer = $('.jam-ke-container[data-jam-ke="' + sesiId + '"]');

                // Show/hide jam_ke-container
                jamKeContainer.toggle(this.checked);

                // Uncheck jam_ke-checkboxes
                jamKeContainer.find('.jam-ke-checkbox').prop('checked', false).prop('hidden', !this
                .checked);
            });

            // Select All functionality
            $('#pilihSemua').change(function() {
                var checked = this.checked;

                // Check/uncheck sesi-checkboxes and trigger change event to update jam_ke-checkboxes
                $('.sesi-checkbox').prop('checked', checked).trigger('change');
            });
        });
    </script>
    <script>
        // <<HAPUS>>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            button.parentNode.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
