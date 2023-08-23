<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahGuru" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
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

@foreach ($guru as $data)
    <div class="modal fade" id="modalDetail{{ $data->id_guru }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $data->id_guru }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel{{ $data->id_guru }}">Detail guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama guru:</strong> {{ $data->nama_guru }}</p>
                    <p><strong>Kelas:</strong> {{ $data->kelas }}</p>
                    <p><strong>Jurusan:</strong> {{ $data->jurusan }}</p>
                    {{-- <img src="{{ asset('img/guru/' . $data->foto) }}" alt="Foto guru" class="img-fluid" style="width: 100px"> --}}
                    <img src="{{ $data->foto ? asset('img/guru/' . $data->foto) : asset('img/siswa/man.png') }}"alt="Foto guru"
                        class="img-fluid" style="width: 100px">
                </div>
            </div>
        </div>
    </div>
@endforeach

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
            <form id="importForm" action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">
                    <div class="form-group">
                        <label for="file">Upload File Harus Sesuai Template!</label>
                        <a href="{{ url('/download-template-guru') }}" class="btn btn-success btn-xs">Download Template
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
