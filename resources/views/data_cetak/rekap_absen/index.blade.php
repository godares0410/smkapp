@extends('layout.master')

@section('title')
    Cetak Kartu
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('datacetak', 'active')
@section('cetak_rekapabsen-active', 'active')

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
                <form action="{{ route('rekap.cari') }}" method="POST" target="_blank">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="jenis">Jenis Ujian</label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            @foreach ($jenis as $data)
                                <option value="{{ $data->id_jenis }}" {{ $data->id_jenis == 113 ? 'selected' : '' }}>
                                    {{ $data->nama_ujian }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            @foreach ($kelas as $data)
                                <option value="{{ $data->id_kelas }}" {{ $data->id_kelas == 3 ? 'selected' : '' }}>{{ $data->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            @foreach ($jurusan as $data)
                                <option value="{{ $data->id_jurusan }}">{{ $data->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <label for="jurusan_mapel">Jurusan Mapel:</label><br> --}}
                    <input type="checkbox" id="selectAll" style="display: none">
                    @foreach ($jurusan as $jurusan_item)
                        <input type="checkbox" name="jurusan_mapel[]" value="{{ $jurusan_item->id_jurusan }}"
                            style="display: none">
                    @endforeach
                    <button type="submit" class="btn btn-success">Cari
                        <i class="fa fa-print"></i>
                    </button>
                </form>
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



        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('input[name="jurusan_mapel[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
            });
        });

        function updateMapelOptions() {
            // Get the selected value from the "kelas" dropdown
            var selectedKelas = document.getElementById("kelas").value;

            // Get the "mapel" dropdown
            var mapelDropdown = document.getElementById("mapel");

            // Set the value of the "mapel" dropdown to "pilih_kelas"
            mapelDropdown.value = "pilih_kelas";

            // Get all options in the "mapel" dropdown
            var mapelOptions = document.querySelectorAll("#mapel .mapel-option");

            // Loop through each option
            mapelOptions.forEach(function(option) {
                // Show the option only if it belongs to the selected "kelas" or if "selectAll" is checked
                if (option.getAttribute("data-kelas") === selectedKelas || document.getElementById("selectAll")
                    .checked) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        }

        // Add an event listener to "kelas" dropdown
        document.getElementById("kelas").addEventListener("change", updateMapelOptions);

        // Add an event listener to "selectAll" checkbox
        document.getElementById("selectAll").addEventListener("change", updateMapelOptions);

        // Trigger the update when the page loads
        updateMapelOptions();


        document.addEventListener("DOMContentLoaded", function() {
            // Code to toggle the visibility of the "Select All" checkbox
            var selectAllCheckbox = document.getElementById("selectAll");

            // Initial state: hidden
            selectAllCheckbox.style.display = "none";

            // Example: Show the checkbox when a specific condition is met (you can customize this condition)
            // For example, if a certain button is clicked
            var showCheckboxButton = document.getElementById("showCheckboxButton");

            showCheckboxButton.addEventListener("click", function() {
                // Toggle the visibility when the button is clicked
                if (selectAllCheckbox.style.display === "none") {
                    selectAllCheckbox.style.display = "inline-block"; // or "block" depending on your layout
                } else {
                    selectAllCheckbox.style.display = "none";
                }
            });
        });
    </script>
@endpush
