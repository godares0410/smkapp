@extends('layout.master')

@section('title')
    PPDB
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ppdb', 'active')
@section('daftar-active', 'active')

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
                            <th style="width: 20px">N0</th>
                            <th>Nama Pendaftar</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>WA</th>
                            <th>Bawaan</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($pendaftar as $data)
                            <td>{{ $counter++ }}</td>
                            <td>{{ $data->nama_pendaftar}}</td>
                            <td>{{ $data->asal_sekolah}}</td>
                            <td>{{ $data->jurusan}}</td>
                            <td>{{ $data->email}}</td>
                            <td>{{ $data->no_wa}}</td>
                            <td>{{ $data->guru}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6 mb-2 text-center">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modalDetail{{ $data->id_pendaftar }}" style="margin-bottom: 5px;">
                                            Detail
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{ route('daftar.destroy', $data->id_pendaftar) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                    </tbody>
                        @endforeach
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_ppdb.modal')
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
