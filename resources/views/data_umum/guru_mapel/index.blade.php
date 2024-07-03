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
<style>
        .container { display: flex; }
        .box { margin: 10px; padding: 10px; border: 1px solid #000; width: 200px; }
        .selected { background-color: #d3d3d3; }
    </style>
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

        <h1>Pilih Guru dan Mapel</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('guru_mapel.store') }}">
    @csrf
    <div class="container">
        <div class="box" id="guruBox">
            <h3>Guru</h3>
            @foreach ($gurus as $guru)
                <div class="guru" data-id="{{ $guru->id }}">{{ $guru->nama_guru }}</div>
            @endforeach
            <input type="hidden" name="nama_guru" id="selectedGuru">
        </div>
        <div class="box" id="mapelBox">
            <h3>Mapel</h3>
            @foreach ($mapels as $mapel)
                <div class="mapel" data-id="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</div>
            @endforeach
            <input type="hidden" name="nama_mapel[]" id="selectedMapel">
        </div>
    </div>
    <button type="submit">Simpan</button>
</form>



    </section>
@endsection


@push('script')
<script>
    document.querySelectorAll('.guru').forEach(guru => {
        guru.addEventListener('click', () => {
            document.querySelectorAll('.guru').forEach(g => g.classList.remove('selected'));
            guru.classList.add('selected');
            document.getElementById('selectedGuru').value = guru.dataset.id;
        });
    });

    document.querySelectorAll('.mapel').forEach(mapel => {
        mapel.addEventListener('click', () => {
            mapel.classList.toggle('selected');
            updateSelectedMapel();
        });
    });

    function updateSelectedMapel() {
        const selectedMapel = [];
        document.querySelectorAll('.mapel.selected').forEach(mapel => {
            selectedMapel.push(mapel.dataset.id);
        });
        document.getElementById('selectedMapel').value = JSON.stringify(selectedMapel);
    }
</script>
@endpush
