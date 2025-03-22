@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Input Absensi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pilih Kelas -->
    <form method="GET" class="mb-4" action="{{ route('attendance.create') }}">
        <div class="form-group">
            <label for="filter_kelas">Pilih Kelas</label>
            <select name="kelas" id="filter_kelas" class="form-control" onchange="this.form.submit()">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id_kelas }}" {{ request('kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                        {{ $kelas->kelas }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Hanya tampilkan form jika kelas sudah dipilih dan ada siswa -->
    @if (!empty($students) && count($students) > 0)
        <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->nm_siswa }}</td>
                            <td>{{ $student->classes->kelas ?? 'Tidak ada kelas' }}</td>

                            <!-- Input Tanggal -->
                            <td>
                                <input type="date" name="attendance[{{ $student->id_siswa }}][date]" class="form-control attendance-date" value="{{ date('Y-m-d') }}">
                            </td>

                            <!-- Dropdown Kehadiran -->
                            <td>
                                <select name="attendance[{{ $student->id_siswa }}][keterangan]" class="form-control attendance-keterangan" onchange="togglePhotoInput(this)">
                                    <option value="present">Hadir</option>
                                    <option value="absent">Absen</option>
                                </select>
                            </td>

                            <!-- Input Foto -->
                            <td>
                                <input type="file" name="attendance[{{ $student->id_siswa }}][foto_izin]" class="form-control attendance-photo" disabled>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        </form>
    @else
        <p>Silakan pilih kelas terlebih dahulu untuk mengisi absensi.</p>
    @endif
</div>

<!-- Script untuk mengisi semua tanggal otomatis dan mengatur input foto -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua elemen dropdown dan input foto
        const dateInputs = document.querySelectorAll('.attendance-date');
        const keteranganSelects = document.querySelectorAll('.attendance-keterangan');

        // Event listener untuk mengatur semua tanggal seragam
        dateInputs.forEach(input => {
            input.addEventListener('change', function() {
                const newDate = this.value;
                dateInputs.forEach(otherInput => {
                    otherInput.value = newDate;
                });
            });
        });

        // Panggil fungsi togglePhotoInput saat halaman pertama kali dimuat
        keteranganSelects.forEach(select => {
            togglePhotoInput(select);
        });
    });

    function togglePhotoInput(select) {
        const photoInput = select.closest('tr').querySelector('.attendance-photo');
        if (select.value === 'absent') {
            photoInput.disabled = false;
        } else {
            photoInput.disabled = true;
            photoInput.value = ''; // Hapus file jika berubah dari absent ke hadir
        }
    }
</script>
@endsection
