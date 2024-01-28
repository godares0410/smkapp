{{-- MODAL DETAIL --}}
@foreach ($pendaftar as $data)
    <div class="modal fade" id="modalDetail{{ $data->id_pendaftar }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $data->id_pendaftar }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel{{ $data->id_pendaftar }}">Detail Pendaftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                            <tr>
                                <th>NIK</th>
                                <th>:</th>
                                <th>{{ $data->nik }}</th>
                            </tr>
                            <tr>
                                <th>NO KK</th>
                                <th>:</th>
                                <th>{{ $data->no_kk }}</th>
                            </tr>
                            <tr>
                                <th>Nama Pendaftar</th>
                                <th>:</th>
                                <th>{{ $data->nama_pendaftar }}</th>
                            </tr>
                            <tr>
                                <th>TTL</th>
                                <th>:</th>
                                <th>{{ $data->tempat }}, {{ $data->ttl }}</th>
                            </tr>
                            <tr>
                                <th>Wali</th>
                                <th>:</th>
                                <th>{{ $data->nama_wali }}</th>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <th>:</th>
                                <th>{{ $data->alamat }}</th>
                            </tr>
                    </table>
                    {{-- <img src="{{ asset('img/siswa/' . $data->foto) }}" alt="Foto Siswa" class="img-fluid" style="width: 100px"> --}}
                    <img src="{{ $data->foto ? asset('img/ppdb/' . $data->foto) : asset('img/siswa/man.png') }}"
                        alt="Foto Siswa" class="img-fluid" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@endforeach