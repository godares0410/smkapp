@extends('layout.master')

@section('title')
    Dashboard
@endsection

@section('dashboard-active', 'active')

@section('badge')
    @parent
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="pad margin no-print">
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    Aplikasi ini akan digunakan seterusnya dalam proses pembelajaran di SMK Sabilillah. Pastikan Anda
                    menggunakan akun login secara konsisten dan selalu ingat username serta password Anda.
                </div>
            </div>
        </div>
        <!-- right col -->
        @if ($idKelas == 3)
            <div class="row">
                @if ($abs->isEmpty())
                    <div class="col-lg-3 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>Belum Absen</h3>
                                <p>Anda Belum Melakukan Absen</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-close"></i>
                            </div>
                            <a href="{{ route('siswa.pkl') }}" class="small-box-footer">Absen Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>Sudah Absen</h3>
                                <p>Anda Sudah Melakukan Absen</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check-square-o"></i>
                            </div>
                            <a href="{{ route('siswa.pkl') }}" class="small-box-footer">Lihat Absen <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </section>
    <!-- /.content -->
@endsection
