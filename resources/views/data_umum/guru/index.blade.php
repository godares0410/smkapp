@extends('layout.master')

@section('title')
    guru
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-umum', 'active')
@section('guru-active', 'active')

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahGuru">Tambah
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Nama guru</th>
                            <th>Jabatan</th>
                            <th>Walas</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($guru as $data)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $data->nama_guru }}</td>
                                <td>
                                    @if ($data->jabatan === null)
                                        Guru
                                    @else
                                        {{ $data->jabatan }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button"
                                        class="btn btn-{{ $data->foto ? 'success' : 'secondary' }} btn-detail"
                                        data-toggle="modal" data-target="#modalDetail{{ $data->id_guru }}">
                                        Detail
                                    </button>
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
            $('.table').DataTable()
        })

        $(document).ready(function() {
            // ...

            // Fungsi untuk membuka modal dan mengatur judul
            function openModal(title) {
                $('.modal-title').text(title);
                // ...
            }

            // Menangkap event tombol dengan atribut data-target="#modalTambahguru"
            $('button[data-target="#modalTambahguru"]').on('click', function() {
                var title = "Tambah Guru";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportguru"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Guru";
                openModal(title);
            });
        });
    </script>
@endpush
