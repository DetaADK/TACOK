@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Kehadiran</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendance->student->nm_siswa }}</td>
                    <td>{{ $attendance->student->classes->kelas ?? 'Tidak ada kelas' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ ucfirst($attendance->keterangan) }}</td>
                    <td>
                        @if($attendance->foto_izin && $attendance->foto_izin !== 'noimage.png')
                            <a href="{{ asset('storage/' . $attendance->foto_izin) }}" target="_blank" class="btn btn-info btn-sm">Lihat Foto</a>
                        @else
                            <img src="{{ asset('storage/noimage.png') }}" alt="No Image" class="img-thumbnail" width="50">
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('attendance.create') }}" class="btn btn-primary">Tambah Kehadiran</a>
</div>
@endsection
