@extends('layout.master')

@section('title')
    Guru
@endsection

@section('data-umum', 'active')
@section('guru-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords(View::getSections()['title']) }}</li>
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
                    timer: 2500 // Menutup pesan dalam 2,5 detik
                });
            </script>
        @endif

        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data {{ ucwords(View::getSections()['title']) }}</h3>
                <div class="pull-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import Data <i class="fa fa-upload"></i></button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahGuru">Tambah <i class="fa fa-plus-circle"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No</th>
                            <th>Nama Guru</th>
                            <th>Jabatan</th>
                            <th class="text-center">Walas</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nama_guru }}</td>
                                <td>{{ ucwords($data->nama_jabatan) }}</td>
                                <td class="text-center">{{ $data->nama_kelas }} - {{ $data->kode_jurusan }}</td>
                                <td>
                                    <button type="button" class="btn btn-{{ $data->foto ? 'success' : 'secondary' }} btn-detail" data-toggle="modal" data-target="#modalDetail{{ $data->id_guru }}">Detail</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @includeIf('data_umum.guru.modal')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
            }

            // Menangkap event tombol dengan atribut data-target="#modalTambahGuru"
            $('button[data-target="#modalTambahGuru"]').on('click', function() {
                openModal("Tambah Guru");
            });

            // Menangkap event tombol dengan atribut data-target="#importModal"
            $('button[data-target="#importModal"]').on('click', function() {
                openModal("Import Data Guru");
            });
        });
    </script>
@endpush
