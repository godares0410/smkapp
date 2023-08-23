@extends('layout.master')

@section('title')
    jenisujian
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-ujian', 'active')
@section('jenis_ujian-active', 'active')

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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">N0</th>
                            <th>Nama Ujian</th>
                            <th>Kode Ujian</th>
                            <th style="width: 25px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($jenis as $jns)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $jns->nama_ujian }}</td>
                                <td>{{ $jns->kode_ujian }}</td>
                                <td>
                                    <form action="{{ route('jenis_ujian.destroy', $jns->id_jenis) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-delete" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_ujian.jenis_ujian.modal')
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

            // Menangkap event tombol dengan atribut data-target="#modalTambahjurusan"
            $('button[data-target="#modalTambahJurusan"]').on('click', function() {
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
    {{-- <script>
        $(document).ready(function () {
        $('.btn-delete').click(function () {
            const form = $(this).closest('form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Menghentikan tindakan default dari tombol

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            button.closest('form')
                                .submit(); // Submit form terdekat yang mengandung tombol yang diklik
                        }
                    });
                });
            });
        });
    </script>
@endpush
