@extends('layout.master')

@section('title')
    gurumapel
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-umum', 'active')
@section('gurumapel-active', 'active')

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
                    text: '{{ session('
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    success ') }}',
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
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No</th>
                            <th class="col-sm-3">Nama Guru</th>
                            <th class="text-center col-sm-3">X</th>
                            <th class="text-center col-sm-3">XI</th>
                            <th class="text-center col-sm-3">XII</th>
                            <th class="text-center col-sm-3">Aksi</th>
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
                                    @foreach ($gurumapel as $mpl)
                                        @if ($mpl->id_guru == $data->id_guru && $mpl->kelas_mapel == 'X')
                                            {{-- {{ $mpl->id_guru }} --}}
                                            <form class="btn btn-xs"
                                                action="{{ route('guru_mapel.destroy', $mpl->id_mpl) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-delete"
                                                    style="background-color: #<?php echo substr(md5(rand()), 0, 6); ?>; display: flex; align-items: center; justify-content: center; border: 2px solid black; color: white; text-shadow: 0 0 2px black;"
                                                    type="submit" id="delete-form">
                                                    {{ $mpl->nama_mapel }} - {{ $mpl->jurusan_mapel }}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($gurumapel as $mpl)
                                        @if ($mpl->id_guru == $data->id_guru && $mpl->kelas_mapel == 'XI')
                                            {{-- {{ $mpl->id_guru }} --}}
                                            <form class="btn btn-xs"
                                                action="{{ route('guru_mapel.destroy', $mpl->id_mpl) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-delete"
                                                    style="background-color: #<?php echo substr(md5(rand()), 0, 6); ?>; display: flex; align-items: center; justify-content: center; border: 2px solid black; color: white; text-shadow: 0 0 2px black;"
                                                    type="submit" id="delete-form">
                                                    {{ $mpl->nama_mapel }} - {{ $mpl->jurusan_mapel }}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($gurumapel as $mpl)
                                        @if ($mpl->id_guru == $data->id_guru && $mpl->kelas_mapel == 'XII')
                                            {{-- {{ $mpl->id_guru }} --}}
                                            <form class="btn btn-xs"
                                                action="{{ route('guru_mapel.destroy', $mpl->id_mpl) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-delete"
                                                    style="background-color: #<?php echo substr(md5(rand()), 0, 6); ?>; display: flex; align-items: center; justify-content: center; border: 2px solid black; color: white; text-shadow: 0 0 2px black;"
                                                    type="submit" id="delete-form">
                                                    {{ $mpl->nama_mapel }} - {{ $mpl->jurusan_mapel }}
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center"><button type="button" class="btn btn-xs btn-success"
                                        data-toggle="modal" data-target="#modalDetail{{ $data->id_guru }}">
                                        <i class="fa fa-plus-circle"></i>
                                        Tambah
                                    </button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @includeIf('data_umum.guru_mapel.modal')
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
            $('button[data-target="#modalDetail"]').on('click', function() {
                var title = "Tambah Mapel Kepada Guru";
                openModal(title);
            });
        });
    </script>
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
