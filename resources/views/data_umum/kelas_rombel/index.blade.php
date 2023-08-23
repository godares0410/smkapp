@extends('layout.master')

@section('title')
    kelasrombel
@endsection

@php
    $title = View::getSections()['title'];
@endphp

@section('data-umum', 'active')
@section('kelas_rombel-active', 'active')

@section('badge')
    @parent
    <li class="active">{{ ucwords($title) }}</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header with-border">
                <div class="row mt-6">
                    @foreach ($rombel as $data)
                        <div class="col-lg-4 col-md-4 col-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $data->nama_rombel }}</h3>
                                    @php
                                        $count = $siswa->where('rombel', $data->nama_rombel)->count();
                                    @endphp
                                    <h2>{{ $count }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- right col -->
    </section>
    <!-- /.content -->
@endsection
