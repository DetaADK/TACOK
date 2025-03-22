@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Foto MBG</h2>

    <form action="{{ route('mbgs.storeFoto', $mbg->id_mbg) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="foto" class="form-label">Pilih Foto</label>
            <input type="file" class="form-control" name="foto" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
        <a href="{{ route('mbgs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
