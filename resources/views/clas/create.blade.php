@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Kelas</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('clas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" required>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('clas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
