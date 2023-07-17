@extends('panels.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    {{--  <h1 class="m-0">Data Siswa</h1>  --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="col-auto mr-auto">Edit Data Siswa</h4>

                        <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm col-auto">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('siswa.update', $siswa->nis) }}">
                        @csrf
                        <div class="mb-2">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                value="{{ $siswa->nama }}">
                        </div>
                        <div class="mb-2">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis"
                                value="{{ $siswa->nis }}" placeholder="NIS">
                        </div>
                        <div class="mb-2">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">-- Pilih Kelas --</option>
                                // check if kelas is equal to kelas on database
                                <option value="X" {{ $siswa->kelas == 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ $siswa->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ $siswa->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="">-- Pilih Jurusan --</option>
                                {{--  check iss , mipa, ibb iik  --}}
                                <option value="IIS" {{ $siswa->jurusan == 'IIS' ? 'selected' : '' }}>ILMU-ILMU
                                    PENGETAHUAN SOSIAL</option>
                                <option value="MIPA" {{ $siswa->jurusan == 'MIPA' ? 'selected' : '' }}>MATEMATIKA DAN ILMU
                                    ALAM</option>
                                <option value="IBB" {{ $siswa->jurusan == 'IBB' ? 'selected' : '' }}>ILMU-ILMU BAHASA DAN
                                    BUDAYA</option>
                                <option value="IIK" {{ $siswa->jurusan == 'IIK' ? 'selected' : '' }}>ILMU-ILMU KEAGAMAAN
                                </option>

                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat">{{ $siswa->alamat }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="pondok">Pondok</label>
                            <select class="js-example-basic-single form-control" id="pondok" name="pondok_id">
                                <option value="">-- Pilih Pondok --</option>
                                @foreach ($pondok as $item)
                                    {{--  check value from database  --}}
                                    <option value="{{ $item->id }}"
                                        {{ $siswa->pondok_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="wali">Wali</label>
                            <select class="js-example-basic-single form-control" id="wali" name="wali_id">
                                <option value="">-- Pilih wali --</option>
                                @foreach ($wali as $item)
                                    {{--  check value from database  --}}
                                    <option value="{{ $item->id }}"
                                        {{ $siswa->wali_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#pondok').select2({
            placeholder: 'Pilih Pondok',
            allowClear: true,
            theme: "classic"
        });
        $('#wali').select2({
            placeholder: 'Pilih Wali',
            allowClear: true,
            theme: "classic"
        });
    </script>
@endpush
