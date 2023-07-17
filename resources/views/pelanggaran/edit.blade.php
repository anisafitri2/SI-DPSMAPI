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
                        <h4 class="col-auto mr-auto">Edit Pelanggaran</h4>

                        <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm col-auto">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pelanggaran.update', $pelanggaran->id) }}">
                        @csrf
                        {{--  siswa  --}}
                        <div class="mb-2">
                            <label for="siswa">Siswa</label>
                            <select class="form-control" id="siswa" name="siswa_id">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pelanggaran->siswa_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  nama pelanggaran  --}}
                        <div class="mb-2">
                            <label for="nama">Nama Pelanggaran</label>
                            <input type="text" class="form-control" id="nama" name="nama_pelanggaran"
                                placeholder="Nama Pelanggaran" value="{{ $pelanggaran->nama_pelanggaran }}">
                            @error('nama_pelanggaran')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  keterangan  --}}
                        <div class="mb-2">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">{{ $pelanggaran->keterangan }}</textarea>
                            @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  tanggal  --}}
                        <div class="mb-2">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal"
                                value="{{ $pelanggaran->tanggal }}">
                            @error('tanggal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  kategori  --}}
                        <div class="mb-2">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Ringan" {{ $pelanggaran->kategori == 'ringan' ? 'selected' : '' }}>Ringan
                                </option>
                                <option value="Sedang" {{ $pelanggaran->kategori == 'sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="Berat" {{ $pelanggaran->kategori == 'berat' ? 'selected' : '' }}>Berat
                                </option>
                            </select>
                            @error('kategori')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
        $('#siswa').select2({
            placeholder: "-- Pilih Siswa --",
            allowClear: true,
            theme: 'classic'
        });
    </script>
@endpush
