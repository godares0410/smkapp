@extends('layout.master')

@section('title')
    mapel
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-pelaksanaan', 'active')
@section('reset-active', 'active')

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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal">Import
                        Data
                        <i class="fa fa-upload"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalTambahMapel">Tambah
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
                            <th>Jenis Ujian</th>
                            <th>Mapel</th>
                            <th>Nilai</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        {{-- @dd($mapel) --}}
                        @foreach ($reset as $data)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $data->nama_siswa }}</td>
                                <td>{{ $data->nama_kelas }}</td>
                                <td>{{ $data->nama_jurusan }}</td>
                                <td>{{ $data->nama_ujian }}</td>
                                <td>{{ $data->nama_mapel }}</td>
                                <td>{{ $data->nilai }}</td>
                                <td class="text-center">
                                    <form action="{{ route('pelaksanaan.resetdestroy', $data->id_siswa_nilai) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- @includeIf('data_umum.mapel.modal') --}}
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

            // Menangkap event tombol dengan atribut data-target="#modalTambahmapel"
            $('button[data-target="#modalTambahMapel"]').on('click', function() {
                var title = "Tambah Mapel";
                openModal(title);
            });
            // Menangkap event tombol dengan atribut data-target="#modalImportmapel"
            $('button[data-target="#importModal"]').on('click', function() {
                var title = "Import Data Mapel";
                openModal(title);
            });
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="jurusan_mapel[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
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
