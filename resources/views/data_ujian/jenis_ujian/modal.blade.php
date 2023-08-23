<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahJenis" tabindex="-1" role="dialog" aria-labelledby="modalTambahJenisLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('jenis_ujian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_ujian">Nama Ujian</label>
                        <input type="text" class="form-control" id="nama_ujian" name="nama_ujian"
                            placeholder="Ujian Akhir Semester" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_ujian">Kode Ujian</label>
                        <input type="text" class="form-control" id="kode_ujian" name="kode_ujian" placeholder="UAS" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>