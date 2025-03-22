@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Daftar Kelas</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('clas.create') }}" class="btn btn-success mb-3">Tambah Kelas</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->id_kelas }}</td>
                        <td>{{ $class->kelas }}</td>
                        <td>{{ $class->jurusan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection