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
                 <div class="pull-right">
                    <button type="submit" onclick="location.href='{{ route('daftarppdb.export') }}'" class="btn btn-success">
    Export Data <i class="fa fa-file-excel-o"></i>
</button>

                </div>
            </div>
            <div class="box-body table-responsive">
                @include('data_ppdb.table', $pendaftar)
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
