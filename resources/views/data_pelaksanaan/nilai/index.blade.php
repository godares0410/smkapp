@extends('layout.master')

@section('title')
    Pelaksanaan
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-pelaksanaan', 'active')
@section('pelaksanaan-active', 'active')

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
                    {{-- <button onclick="addForm()" class="btn btn-success">Import
                        <i class="fa fa-upload"></i>
                    </button> --}}
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import
                        Data
                        <i class="fa fa-upload"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahSiswa">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Mapel</th>
                            <th>Detail</th>
                            <th>Action</th>
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
                                <td>{{ $data->nama_kelas }}</td>
                                <td>{{ $data->nama_jurusan }}</td>
                                <td>{{ $data->nama_mapel }}</td>
                                <td>
                                    <span class="label"
                                        style="background-color: rgb(37, 0, 172)">{{ $data->total }}</span>
                                    <span class="label"
                                        style="background-color: rgb(0, 133, 0)">{{ $data->tidak_terjawab }}</span>
                                    <span class="label"
                                        style="background-color: rgb(255, 0, 0)">{{ $data->terjawab }}</span>
                                    <span class="label"
                                        style="background-color: rgb(63, 0, 58)">{{ $data->nilai }}</span>

                                </td>
                                <td>
                                    <div class="btn-group" style="display: flex;">
                                        <form
                                            action="{{ route('pelaksanaan.selesaikan', [$data->id_siswa, $data->id_jadwal_ujian]) }}"
                                            method="POST" style="margin-right: 3px">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Paksa Selesai</button>
                                        </form>
                                        <form
                                            action="{{ route('pelaksanaan.destroy', [$data->id_siswa, $data->id_jadwal_ujian]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- @includeIf('data_umum.siswa.modal') --}}
@endsection

@push('script')
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

            // Menangkap event tombol dengan atribut data-target="#modalTambahSiswa"
            $('button[data-target="#modalTambahSiswa"]').on('click', function() {
                var title = "Tambah Siswa";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportSiswa"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Siswa";
                openModal(title);
            });
        });


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
