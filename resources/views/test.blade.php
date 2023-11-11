@if (auth()->check())
    <p>Halo, {{ auth()->user()->name }}</p>
@else
    <p>Halo, {{ auth('siswa')->user()->nama_siswa }}</p>
@endif
