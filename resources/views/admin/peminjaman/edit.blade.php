@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Buku</div>
                    <div class="card-body">
                        <form action="{{ route('peminjaman.update', $pinjam->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Tanggal Pinjam</label>
                                <input type="date" name="tanal_pinjam" value="{{ $pinjam->tanal_pinjam }}"
                                    class="form-control @error('tanal_pinjam') is-invalid @enderror">
                                @error('tanal_pinjam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" value="{{ $pinjam->tanggal_kembali }}"
                                    class="form-control @error('tanggal_kembali') is-invalid @enderror">
                                @error('tanggal_kembali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Nama Buku</label>
                                <select name="buku_id" class="form-control @error('buku_id') is-invalid @enderror" >
                                    @foreach($pinjam as $data)
                                        <option value="{{$data->id}}">{{$data->buku_id}}</option>
                                    @endforeach
                                </select>
                                @error('buku_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Anggota</label>
                                <input type="text" name="Anggota_id" value="{{ $pinjam->Anggota_id }}"
                                    class="form-control @error('Anggota_id') is-invalid @enderror">
                                @error('Anggota_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="reset" class="btn btn-outline-warning">Reset</button>
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
