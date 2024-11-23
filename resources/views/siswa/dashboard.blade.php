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
                                <h3>Belum Absen Masuk</h3>
                                <p>Anda Belum Melakukan Absen</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-close"></i>
                            </div>
                            <a href="{{ route('siswa.pklmasuk') }}" class="small-box-footer">Absen Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>Sudah Absen Masuk</h3>
                                <p>Anda Sudah Melakukan Absen Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check-square-o"></i>
                            </div>
                            {{-- <button type="button" class="btn btn-block btn-success btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#masuk">Lihat Scan Masuk 
                            <i class="fa fa-arrow-circle-right"></i>
                             </button> --}}
                        </div>
                    </div>
                @endif
            </div>
        @endif
        @if ($idKelas == 3 && !$abs->isEmpty())
            <div class="row">
                @if ($absp->isEmpty())
                    <div class="col-lg-3 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>Belum Absen Pulang</h3>
                                <p>Anda Belum Melakukan Absen Pulang</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-close"></i>
                            </div>
                            <a href="{{ route('siswa.pklpulang') }}" class="small-box-footer">Absen Sekarang <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>Sudah Absen Pulang</h3>
                                <p>Anda Sudah Melakukan Absen</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check-square-o"></i>
                            </div>
                            {{-- <button type="button" class="btn btn-block btn-success btn-xs mx-2" data-bs-toggle="modal" data-bs-target="#pulang">Lihat Scan Pulang 
                            <i class="fa fa-arrow-circle-right"></i>
                             </button> --}}
                        </div>
                    </div>
                @endif
            </div>
        @endif
         <!-- Modal Masuk-->
     <div class="modal fade" id="masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Scan Masuk {{ Auth::guard('siswa')->user()->nama_siswa }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($masuk && $masuk->foto != null)
                        <img class="siswa" src="{{ asset('img/scan/masuk/' . $masuk->foto) }}" style="width: 100%" alt="Foto Siswa">
                    @else
                        Tidak Ada Foto
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="pulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Scan Pulang {{ Auth::guard('siswa')->user()->nama_siswa }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($pulang && $pulang->foto != null)
                        <img class="siswa" src="{{ asset('img/scan/pulang/' . $pulang->foto) }}" style="width: 100%" alt="Foto Siswa">
                    @else
                        Tidak Ada Foto
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    </section>
    <!-- /.content -->
@endsection
@push('script')
<script>
        // Get the modal
        var modal = document.getElementById('masuk');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        // Get the modal
        var modal = document.getElementById('pulang');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
    function showImageModal(src) {
        var enlargedImage = document.getElementById('enlargedImage');
        enlargedImage.src = src;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</script>
@endpush