@extends('panels.master')

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
            <div class="card shadow mb-4">
                <a href="#data_siswa" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="data_siswa">
                    <h6 class="m-0 font-weight-bold text-primary">Details Siswa Dari {{ $siswa->wali->name }}</h6>
                </a>
                <div class="collapse show" id="data_siswa">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $siswa->nama }}</td>
                                        <th>NIS</th>
                                        <td>{{ $siswa->nis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>{{ $siswa->kelas }}</td>
                                        <th>Jurusan</th>
                                        {{--  check all value jurusan and return the real value --}}
                                        <td>
                                            @if ($siswa->jurusan == 'IIS')
                                                ILMU-ILMU PENGETAHUAN SOSIAL
                                            @elseif ($siswa->jurusan == 'MIPA')
                                                MATEMATIKA DAN ILMU ALAM
                                            @elseif ($siswa->jurusan == 'IBB')
                                                ILMU-ILMU BAHASA DAN BUDAYA
                                            @elseif ($siswa->jurusan == 'IIK')
                                                ILMU-ILMU KEAGAMAAN
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $siswa->alamat }}</td>
                                        <th>Pondok</th>
                                        <td>{{ $siswa->pondok->nama }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <a href="#pelanggaran" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="pelanggaran">
                    <h6 class="m-0 font-weight-bold text-primary">Details Pelanggaran</h6>
                </a>
                <div class="collapse show" id="pelanggaran">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Pelanggaran</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Kategori</th>
                                </thead>
                                <tbody>
                                    @foreach ($siswa->pelanggaran as $pelanggaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pelanggaran->nama_pelanggaran }}</td>
                                            <td>{{ $pelanggaran->tanggal }}</td>
                                            <td>{{ $pelanggaran->keterangan }}</td>
                                            <td
                                                class="@if ($pelanggaran->kategori == 'ringan') badge-success
                                            @elseif ($pelanggaran->kategori == 'sedang') badge-warning @else badge-danger @endif">
                                                {{ $pelanggaran->kategori }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
