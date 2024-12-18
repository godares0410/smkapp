<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Top Navigation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/dist/css/skins/_all-skins.min.css') }}">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
  <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue fixed layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SMK</b>App</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle"
                                                        alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               @if(auth('siswa')->user()->foto != null)
                                    <img src="{{ asset('img/siswa/' . auth('siswa')->user()->foto) }}" class="user-image" alt="User Image">
                                @else
                                    <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                @endif
                                <span class="hidden-xs">{{ auth('siswa')->user()->nama_siswa }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if (auth('siswa')->check())
                                        @if(auth('siswa')->user()->foto != null)
                                            <img src="{{ asset('img/siswa/' . auth('siswa')->user()->foto) }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" alt="User Image">
                                        @else
                                            <img src="{{ asset('img/siswa/icon.jpg') }}" class="user-image" alt="User Image">
                                        @endif
                                    @endif
                                    @if (auth('web')->check())
                                        <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                    @endif

                                    <p>{{ auth('siswa')->user()->nama_siswa }}
                                        {{-- <small>Member since Nov. 2012</small> --}}
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat"
                                            onclick="document.getElementById('logout-form').submit()">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none">
                            @csrf
                        </form>

                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    {{-- <h1>
                        {{ $ujian->nama_mapel }}
                    </h1> --}}

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box">
                        <div class="box-header with-border">
                            {{-- <h3 class="box-title">{{ $idUj }}</h3> --}}
                            <!-- Button to trigger the modal -->
                            <div class="pull-right">
                                <button class="btn btn-success" onclick="refreshHalaman()"><i
                                        class="fa  fa-refresh"></i></button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#soalModal" id="btnDaftarSoal">
                                    Daftar Soal
                                </button>
                            </div>
                        </div>
                        @if (session('sukses'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: '{{ session('sukses') }}',
                                    showConfirmButton: true
                                })
                            </script>
                        @endif
                        <div class="box-body">
    <div id="soal-container">
        @php
            $counter = 1;
        @endphp
        @foreach ($soal as $index => $sl)
            <div class="pertanyaan-{{ $sl->id_soal }}" id="question-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                @if ($sl->file_1 != null && isset($bank_soal))
                    <img src="{{ asset('bank_soal/' . $bank_soal->nama_bank_soal . '/' . $sl->file_1) }}" alt="Deskripsi Gambar" style="width: 100%">
                @endif
                <h3>{{ $counter++ }}. {{ $sl->soal }}</h3><br>
                <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_soal" value="{{ $sl->id_soal }}">
                    <button type="button" class="answer-btn btn-lg {{ $sl->soal_jawaban == 'A' ? 'btn-success' : '' }}" data-answer="{{ encrypt($sl->pil_a) }}">A</button>
                    {{ $sl->pil_a }}<br>
                    <button type="button" class="answer-btn btn-lg {{ $sl->soal_jawaban == 'B' ? 'btn-success' : '' }}" data-answer="{{ encrypt($sl->pil_b) }}">B</button>
                    {{ $sl->pil_b }}<br>
                    <button type="button" class="answer-btn btn-lg {{ $sl->soal_jawaban == 'C' ? 'btn-success' : '' }}" data-answer="{{ encrypt($sl->pil_c) }}">C</button>
                    {{ $sl->pil_c }}<br>
                    <button type="button" class="answer-btn btn-lg {{ $sl->soal_jawaban == 'D' ? 'btn-success' : '' }}" data-answer="{{ encrypt($sl->pil_d) }}">D</button>
                    {{ $sl->pil_d }}<br>
                    @if ($sl->pil_e != null)
                        <button type="button" class="answer-btn btn-lg {{ $sl->soal_jawaban == 'E' ? 'btn-success' : '' }}" data-answer="{{ encrypt($sl->pil_e) }}">E</button>
                        {{ $sl->pil_e }}<br>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
</div>
<footer class="main-footer">
    <div class="container">
        <div class="col-lg-4 col-xs-4">
            <div class="text-center">
                <button class="btn btn-primary" id="prev-btn">Sebelumnya</button>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="text-center">
                <button type="button" class="btn btn-warning btn-ragu">Ragu</button>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4">
            <div class="text-right">
                <button class="btn btn-primary pull-right" id="next-btn">Selanjutnya</button>
            </div>
        </div>
    </div>
</footer>

            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="soalModal" tabindex="-1" role="dialog" aria-labelledby="soalModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="soalModalLabel">Pastikan Tidak Ada Soal Terlewat</h4>
                </div>
                <div class="modal-body">
                    <!-- Generate buttons for each question -->
                    @foreach ($soal as $sl)
                        @php
                            $isSoalJawabanNotNull = !is_null($sl->soal_jawaban);
                        @endphp

                        <button type="button"
                            class="btn btn-{{ $isSoalJawabanNotNull ? 'success' : 'default' }} btn-soal"
                            data-nomor="{{ $loop->iteration }}" style="width: 19%">
                            {{ $loop->iteration }}
                        </button>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('AdminLTE-2/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-2/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-2/dist/js/demo.js') }}"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    let currentQuestion = 0;
    const questions = document.querySelectorAll('[id^=question-]');
    const totalQuestions = questions.length;

    document.getElementById('next-btn').addEventListener('click', function() {
        if (currentQuestion < totalQuestions - 1) {
            questions[currentQuestion].style.display = 'none';
            currentQuestion++;
            questions[currentQuestion].style.display = 'block';
        }
    });

    document.getElementById('prev-btn').addEventListener('click', function() {
        if (currentQuestion > 0) {
            questions[currentQuestion].style.display = 'none';
            currentQuestion--;
            questions[currentQuestion].style.display = 'block';
        }
    });
});
</script>


</body>

</html>
