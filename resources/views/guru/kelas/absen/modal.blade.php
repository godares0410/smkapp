{{-- MODAL EDIT --}}
@foreach ($siswa as $data)
    <div class="modal fade" id="modalAbsen{{ $data->id_siswa }}" tabindex="-1" role="dialog"
        aria-labelledby="modalAbsenLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$data->nama_siswa}}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswas.absens', $data->id_siswa) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control" id="keterangan" name="keterangan" required>
                                <option value="A">Alpa</option>
                                <option value="S">Sakit</option>
                                <option value="I">Izin</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <input type="checkbox" class="sehari"> Sehari <br><br>
                        <label for="jam">Jam ke :</label>
                        <br>
                        @for ($i = 1; $i <= 8; $i++)
                            <input type="checkbox" name="jam[]" value="{{ $i }}"> {{ $i }}<br>
                        @endfor
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
@endforeach