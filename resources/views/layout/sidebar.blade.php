    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                @if (auth('siswa')->check())
                 @if(auth('siswa')->user()->foto != null)
                        <img src="{{ asset('img/siswa/' . auth('siswa')->user()->foto) }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" alt="User Image">
                    @else
                        <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    @endif
                @endif
                @if (auth('web')->check())
                    <img src="{{ asset('img/guru/foto.jpg') }}" class="img-circle" alt="User Image">
                    <!-- <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> -->
                @endif
                </div>
                <div class="pull-left info">
                    @if (auth('web')->check())
                        @php
                            $nama = auth()->user()->name;
                        @endphp
                    @elseif (auth('siswa')->check())
                        @php
                            $nama = auth('siswa')->user()->nama_siswa;
                        @endphp
                    @elseif (auth('guru')->check())
                        @php
                            $nama = auth('guru')->user()->nama_guru;
                        @endphp
                    @else
                        @php
                            $nama = 'tidak ada nama';
                        @endphp
                    @endif
                    <p>{{ $nama }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="@yield('dashboard-active')">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <!-- SIDEBAR ADMIN -->
                @if (auth('web')->check())
                    {{-- @unless (auth('siswa')->check()) --}}
                    <li class="@yield('data-umum') treeview">
                        <a href="#">
                            <i class="fa fa-cubes"></i>
                            <span>Data Umum</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('tapel-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    Tahun Pelajaran</a></li>
                            <li class="@yield('guru-active')"><a href="{{ route('guru.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Guru</a></li>
                            <li class="@yield('siswa-active')"><a href="{{ route('siswa.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Siswa</a></li>
                            <li class="@yield('mapel-active')"><a href="{{ route('mapel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Mapel</a></li>
                            <li class="@yield('gurumapel-active')"><a href="{{ route('guru_mapel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Guru dan Mapel</a></li>
                            <li class="@yield('jurusan-active')"><a href="{{ route('jurusan.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jurusan</a></li>
                            <li class="@yield('kelas_rombel-active')"><a href="{{ route('kelas_rombel.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Kelas/Rombel</a></li>
                            <li class="@yield('ekstrakulikuler-active')"><a
                                    href="{{ asset('AdminLTE-2/pages/charts/chartjs.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ekstrakulikuler</a></li>
                        </ul>
                    </li>
                    {{-- @endunless --}}
                    <li class="@yield('data-ujian') treeview ">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>Data Ujian</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @if (auth('web')->user()->level == 1)
                        <ul class="treeview-menu">
                            <li class="@yield('banksoal-active')"><a href="{{ route('banksoal.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Bank Soal</a></li>
                            <li class="@yield('ujian-active')"><a href="{{ route('bankujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ujian</a></li>
                            <li class="@yield('jadwal_ujian-active')"><a href="{{ route('jadwal_ujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jadwal Ujian</a></li>
                            <li class="@yield('jenis_ujian-active')"><a href="{{ route('jenis_ujian.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Jenis Ujian</a></li>
                            <li class="@yield('sesi-active')"><a href="{{ route('sesi.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Sesi</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ruang</a></li>
                            {{-- <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ruang dan Sesi</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Nomor Peserta</a></li> --}}
                            <li class="@yield('alokasi-active')"><a href="{{ route('alokasi.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Alokasi Waktu</a></li>
                            {{-- <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Token</a></li> --}}
                        </ul>
                    </li>
                    @endif
                    <li class="@yield('data-pelaksanaan') treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>Data Pelaksanaan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('pelaksanaan-active')"><a href="{{ route('pelaksanaan.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Pelaksanaan</a></li>
                                    @if (auth('web')->user()->level == 1)
                            <li class="@yield('reset-active')"><a href="{{ route('pelaksanaan.reset') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Reset</a></li>
                                    @endif
                        </ul>
                    </li>
                    <li class="@yield('token-active')">
                        <a href="{{ route('token.index') }}">
                            <i class="fa fa-key"></i> <span>Token</span>
                        </a>
                    </li>
                    <li class="@yield('assesment') treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Assessmen</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('rekap-active')"><a href="{{ route('score.rekap') }}"><i
                                        class="fa fa-circle-o"></i>Rekap Nilai</a>
                            </li>
                            <li class="@yield('nilai-active')"><a href="{{ route('score.index') }}"><i
                                        class="fa fa-circle-o"></i>Hasil Ujian</a></li>
                            <li><a href="{{ asset('AdminLTE-2/pages/UI/general.html') }}"><i
                                        class="fa fa-circle-o"></i>Cetak Nilai</a></li>
                        </ul>
                    </li>
                    <li class="@yield('datacetak') treeview">
                        <a href="#">
                            <i class="fa fa-print"></i> <span>Cetak</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('daftar_hadir-active')"><a href="{{ route('cetak.index') }}"><i
                                        class="fa fa-circle-o"></i>Daftar Hadir</a>
                            </li>
                            <li class="@yield('cetak_kartu-active')"><a href="{{ route('kartu.index') }}"><i
                                        class="fa fa-circle-o"></i>Kartu Peserta</a>
                            </li>
                            <li class="@yield('cetak_ktp-active')"><a href="{{ route('ktp.index') }}"><i
                                        class="fa fa-circle-o"></i>Kartu Tanda Pelajar</a>
                            </li>
                            <li class="@yield('cetak_rekapabsen-active')"><a href="{{ route('rekapabsen.index') }}"><i
                                        class="fa fa-circle-o"></i>Rekap Absen</a>
                            </li>
                        </ul>
                    </li>
                    @if (auth('web')->user()->level == 1)
                    <li class="@yield('data-website') treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>Data website</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('beranda-active')"><a href="{{ route('website.beranda') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Website</a></li>
                            <li class="@yield('berita-active')"><a href="{{ route('website.berita') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Berita</a></li>
                        </ul>
                    </li>
                    <li class="@yield('data-ppdb') treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>Data PPDB</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('daftar-active')"><a href="{{ route('daftar.ppdb') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Pendaftar</a></li>
                        </ul>
                    </li>
                    @endif
                @endif
                <!-- SIDEBAR GURU -->
                    @if (auth('guru')->check())
                        @if (auth()->user()->walas)
                        <li class="@yield('struktur') treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i>
                                <span>Kelas</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@yield('struktur-active')"><a href="{{ route('guru.absen') }}"><i
                                            class="fa fa-circle-o"></i>
                                        Absen</a></li>
                                <li class="@yield('laporan-active')"><a href="{{ route('siswas.absenlaporan') }}"><i
                                            class="fa fa-circle-o"></i>
                                        Laporan</a></li>
                            </ul>   
                        </li>
                        @endif
                    @endif

                <!-- SIDEBAR SISWA -->
                @if (auth('siswa')->check())
                    <li class="@yield('assesmen') treeview">
                        <a href="#">
                            <i class="fa fa-cubes"></i>
                            <span>Assessmen</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('assesmen-active')"><a href="{{ route('siswas.index') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Ujian</a></li>
                            {{-- <li class="@yield('siswa-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    Tugas</a></li>
                            <li class="@yield('guru-active')"><a href="#"><i class="fa fa-circle-o"></i>
                                    E-Learning</a></li> --}}
                        </ul>
                    </li>
                    @if (auth('siswa')->user()->rule != 0)
                    <li class="@yield('struktur') treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>Kelas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('struktur-active')"><a href="{{ route('siswas.absen') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Absen</a></li>
                            <li class="@yield('laporan-active')"><a href="{{ route('siswas.absenlaporan') }}"><i
                                        class="fa fa-circle-o"></i>
                                    Laporan</a></li>
                        </ul>   
                    </li>
                    @endif
                   
                @endif
        </section>
        <!-- /.sidebar -->
    </aside>
