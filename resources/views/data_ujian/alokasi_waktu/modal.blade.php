<div class="modal fade" id="modalTambahBankSoal" tabindex="-1" role="dialog" aria-labelledby="modalTambahBankSoalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('alokasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="sesi">Nama Sesi</label>
                        <select class="form-control" id="sesi" name="sesi" required>
                            @foreach ($sesi as $data)
                                <option value="{{ $data->id_sesi }}">{{ $data->nama_sesi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_sesi">Jam Sesi Ke</label>
                        <input type="text" class="form-control" name="jam_sesi" id="jam_sesi">
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" id="jam_mulai">
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" id="jam_selesai">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- MODAL EDIT --}}
@foreach ($alokasi as $data)
    <div class="modal fade" id="modalEdit{{ $data->id_alokasi_waktu }}" tabindex="-1" role="dialog"
        aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.update', $data->id_alokasi_waktu) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="sesi">Sesi</label>
                            <select class="form-control" id="sesi" name="sesi" required>
                                @foreach ($sesi as $data)
                                    <option value="{{ $data->id_sesi }}">{{ $data->nama_sesi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="jam_sesi">Jam Sesi Ke</label>
                        <input type="text" class="form-control" name="jam_sesi" id="jam_sesi" value="{{$data->id_jam_ke}}">
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ $data->jam_mulai }}">
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="{{$data->jam_selesai}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach