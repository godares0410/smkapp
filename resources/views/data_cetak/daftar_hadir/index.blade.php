@extends('layout.master')

@section('title')
    Cetak
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('datacetak', 'active')
@section('daftar_hadir-active', 'active')

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
                <form action="{{ route('cetak.daftarhadir') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="jenis">Jadwal Ujian</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            @foreach ($jadwal as $data)
                                <option value="{{ $data->id_jadwal_ujian }}">{{ $data->nama_ujian }} {{$data->nama_mapel}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sesi">Sesi</label>
                        <select class="form-control" id="sesi" name="sesi" required>
                            @foreach ($sesi as $data)
                                <option value="{{ $data->id_sesi }}">{{ $data->nama_sesi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ruang">Ruang</label>
                        <select class="form-control" id="ruang" name="ruang" required>
                            @foreach ($ruang as $data)
                                <option value="{{ $data->id_ruang }}">{{ $data->nama_ruang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hadir">Siswa Hadir</label>
                        <select class="form-control" id="hadir" name="hadir" required>
                            <option value="1">Hadir Semua</option>
                            <option value="2">Ada Siswa Tidak Hadir</option>
                        </select>
                    </div>

                    <div class="form-group tdkhadir">
                        <label for="tdkhadir">Jumlah Tidak Hadir</label>
                        <input type="tdkhadir" class="form-control" name="tdkhadir" value="0">
                    </div>
                    <div class="form-group">
                        <label for="proktor">Nama Proktor</label>
                        <select class="form-control" id="proktor" name="proktor" required>
                            <option value="Ach. Alfan Taufiqi, S.Pd">Ach. Alfan Taufiqi, S.Pd</option>
                            <option value="Taufiqur Rahman, S.Kom">Taufiqur Rahman, S.Kom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengawas">Nama Pengawas</label>
                        <input type="pengawas" class="form-control" name="pengawas" required="required">
                    </div>
                    <button type="submit" class="btn btn-success">Cari
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
       document.addEventListener("DOMContentLoaded", function() {
        var hadirSelect = document.getElementById('hadir');
        var tdkhadirInput = document.querySelector('.form-group.tdkhadir');

        hadirSelect.addEventListener('change', function() {
            if (hadirSelect.value === '2') {
                tdkhadirInput.style.display = 'block';
            } else {
                tdkhadirInput.style.display = 'none';
            }
        });

        // Initially hide the input if "Hadir Semua" is selected by default
        if (hadirSelect.value === '1') {
            tdkhadirInput.style.display = 'none';
        }
    });
    </script>
@endpush
