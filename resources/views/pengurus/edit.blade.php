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
                        <h4 class="col-auto mr-auto">Edit Pengurus</h4>

                        <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm col-auto">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('pengurus.update', $pengurus->id) }}">
                        @csrf
                        {{--  edit name  --}}
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Masukkan Nama" name="name" value="{{ $pengurus->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{--  edit email  --}}
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Masukkan Email" name="email" value="{{ $pengurus->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{--  edit pondok  --}}
                        <div class="mb-2">
                            <label for="pondok" class="form-label">Pondok</label>
                            <select class="form-control @error('pondok') is-invalid @enderror" id="pondok_id"
                                name="pondok_id">
                                <option value="">-- Pilih Pondok --</option>
                                @foreach ($pondok as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $pengurus->pondok_id) selected @endif>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('pondok_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{--  edit password  --}}
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Masukkan Password" name="password" v>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
