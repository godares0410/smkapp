<!-- Modal -->

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"> --}}
<div class="modal fade" id="modalTambahJenis" tabindex="-1" role="dialog" aria-labelledby="modalTambahJenisLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('jadwal_ujian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bank_ujian">Pilih Bank Ujian</label>
                        <select class="form-control" id="bank_ujian" name="bank_ujian" required>
                            @foreach ($bank as $ujn)
                                @php
                                    $decodedIdJurusanValues = json_decode($ujn->id_jurusan, true);
                                    $matchingKodeJurusanValues = \App\Models\Jurusan::whereIn('id_jurusan', $decodedIdJurusanValues)
                                        ->pluck('kode_jurusan')
                                        ->toArray();
                                @endphp
                                <option value="{{ $ujn->id_bank_ujian }}">{{ $ujn->nama_ujian }} :
                                    {{ $ujn->nama_mapel }} {{ $ujn->nama_kelas }}-(
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

                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Dalam Satuan Menit" value="60" required>
                    </div>
                     @php
                        $today = \Carbon\Carbon::now()->timezone('Asia/Jakarta');
                        $formattedDate = $today->format('Y-m-d');
                        $tomorrow = $today->addDay(); // Add one day to get tomorrow's date
                        $besok = $tomorrow->format('Y-m-d');
                    @endphp
                    <div class="form-group">
                        <label for="mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="mulai" name="mulai" required value="{{$formattedDate}}">
                    </div>
                    <div class="form-group">
                        <label for="selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="selesai" name="selesai" required value="{{$besok}}">
                    </div>
<div class="container">
    <div class="form-group">
        <label for="jurusan_mapel">Sesi :</label><br>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="pilihSemua"> Select All
            </label>
        </div>

        @php
            $alokasiArray = $alokasi->toArray();
            $uniqueSesi = array_unique(array_column($alokasiArray, 'id_sesi'));
        @endphp

        @foreach ($uniqueSesi as $idSesi)
            @php
                $sesiDetails = array_filter($alokasiArray, function($item) use ($idSesi) {
                    return $item['id_sesi'] == $idSesi;
                });
                $namaSesi = reset($sesiDetails)['nama_sesi'];
            @endphp

            <div style="margin-left: 20px; margin-top: 10px;">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="sesi[]" value="{{ $idSesi }}" class="sesi-checkbox" data-sesi="{{ $idSesi }}">
                        {{ $namaSesi }}
                    </label>
                </div>

                <div style="margin-left: 20px; display: none;" class="jam-ke-container" data-jam-ke="{{ $idSesi }}">
                    <p>Jam ke:</p>

                    @php
                        $uniqueJamKe = array_unique(array_column($sesiDetails, 'id_jam_ke'));
                    @endphp

                    @foreach ($uniqueJamKe as $idJamKe)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="jam_ke[]" value="{{ $idJamKe }}" class="jam-ke-checkbox" data-jam-ke="{{ $idJamKe }}" hidden>
                                {{ $idJamKe }} ({{ date('H:i', strtotime(reset($sesiDetails)['jam_mulai'])) }} - {{ date('H:i', strtotime(reset($sesiDetails)['jam_selesai'])) }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
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
