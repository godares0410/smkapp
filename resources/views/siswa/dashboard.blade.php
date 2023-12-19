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
    </section>
    <!-- /.content -->
@endsection
