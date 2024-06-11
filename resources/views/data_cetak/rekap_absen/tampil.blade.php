@extends('layout.master')

@section('title')
    Rekap Absen
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('assesment', 'active')
@section('nilai-active', 'active')

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
                    <form action="{{ route('nilai.export') }}" method="POST" style="margin-left: 10px;">
                        @csrf
                        <a href="/score" class="btn btn-warning">
                            Kembali <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="submit" href="{{ route('nilai.export') }}" class="btn btn-success">Export Nilai
                            <i class="fa  fa-file-excel-o"></i>
                        </button>
                    </form>
                </div>
            </div>
            @include('data_cetak.rekap_absen.table', $score)
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
