@foreach ($guru as $data)
    <div class="modal fade" id="modalDetail{{ $data->id_guru }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $data->id_guru }}" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Mapel Kepada</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Guru :</label>
                        <input type="text" class="form-control" placeholder="{{ $data->nama_guru }}" readonly>
                    </div>
                    <form action="{{ route('guru_mapel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" id="id_guru" name="id_guru"
                            value="{{ $data->id_guru }}">
                        <div class="form-group">
                            <label for="kelas">Nama Mapel</label>
                            <select class="form-control" id="id_mapel" name="id_mapel" required>
                                @foreach ($mapel as $mpl)
                                    @php
                                        $isSelected = false;
                                    @endphp

                                    @foreach ($gurumapel as $selected)
                                        @if ($mpl->id_mapel == $selected->id_mpl)
                                            @php
                                                $isSelected = true;
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if (!$isSelected)
                                        <option value="{{ $mpl->id_mapel }}">{{ $mpl->nama_mapel }} -
                                            {{ $mpl->kelas_mapel }} {{ $mpl->jurusan_mapel }}</option>
                                    @endif
                                @endforeach
                            </select>
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
                    <p><strong>ID :</strong> {{ $data->id_guru }}</p>
                    <p><strong>Nama guru :</strong> {{ $data->nama_guru }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
