<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahBankSoal" tabindex="-1" role="dialog" aria-labelledby="modalTambahBankSoalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('banksoal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_bank_soal">Nama Bank Soal</label>
                        <input type="text" class="form-control" id="nama_bank_soal" name="nama_bank_soal" value="PSAT 2024 " required>

                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            @foreach ($kelas as $kls)
                                <option value="{{ $kls->id_kelas }}">{{ $kls->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mapel">Mapel</label>
                        <select class="form-control" id="mapel" name="mapel" required>
                            <option value="pilih_kelas">Pilih Mapel</option>
                            @foreach ($mapel as $mpl)
                                @php
                                    $decodedIdJurusanValues = json_decode($mpl->id_jurusan, true);
                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                        ->pluck('kode_jurusan')
                                        ->toArray();
                                @endphp
                                <option class="mapel-option" value="{{ $mpl->id_mapel }}"
                                    data-kelas="{{ $mpl->id_kelas }}">
                                    {{ $mpl->nama_mapel }} (
                                    @foreach ($matchingKodeJurusanValues as $index => $kodeJurusan)
                                        {{ $kodeJurusan }}
                                        @if ($index < count($matchingKodeJurusanValues) - 1)
                                            ,
                                        @endif
                                    @endforeach
                                    )
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <label for="jurusan_mapel">Jurusan Mapel:</label><br> --}}
                    <input type="checkbox" id="selectAll" style="display: none">
                    @foreach ($jurusan as $jurusan_item)
                        <input type="checkbox" name="jurusan_mapel[]" value="{{ $jurusan_item->id_jurusan }}"
                            style="display: none">
                    @endforeach
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
            <form id="importForm" action="{{ route('jurusan.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body md-10">
                    <div class="form-group">
                        <label for="file">Upload File Harus Sesuai Templateeee!</label>
                        <a href="{{ url('/download-template-jurusan') }}" class="btn btn-success btn-xs">Download
                            Template
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
