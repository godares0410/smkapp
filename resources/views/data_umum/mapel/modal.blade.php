<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahMapel" tabindex="-1" role="dialog" aria-labelledby="modalTambahMapelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_mapel">Nama Mapel</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="nama_kelas" name="nama_kelas" required>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->nama_kelas }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="kode_jurusan" name="kode_jurusan" required>
                            @foreach ($jurusan as $jrs)
                                <option value="{{ $jrs->kode_jurusan }}">{{ $jrs->kode_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="rombel" name="rombel" required>
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

<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <form id="importForm" action="{{ route('mapel.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">
                    <div class="form-group">
                        <label for="file">Upload File Harus Sesuai Template!</label>
                        <a href="{{ url('/download-template-mapel') }}" class="btn btn-success btn-xs">Download Template
                            Excel
                            <i class="fa fa-download"></i></a>
                    </div>

                    <div class="form-group mt-10">
                        <label for="file">Upload :</label>
                        <input type="file" name="file" id="file" required>
                        <p class="help-block">File harus berupa xls/xlsx</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
