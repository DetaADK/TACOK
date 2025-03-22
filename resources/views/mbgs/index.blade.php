@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Data MBGs</h2>
    <a href="{{ route('mbgs.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Kelas</th>
                    <th>Total Siswa</th>
                    <th>Total Hadir</th>
                    <th>Diambil</th>
                    <th>Dikembalikan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    @php
                        $mbg = $mbgs->where('id_kelas', $class->id_kelas)->first();
                    @endphp
                    <tr>
                        <td class="align-middle">{{ $class->kelas }}</td>
                        <td class="align-middle">{{ $mbg->total_siswa ?? 0 }}</td>
                        <td class="align-middle">{{ $mbg->total_hadir ?? 0 }}</td>
                        <td class="align-middle">
                            <input type="checkbox" class="toggle-status form-check-input" data-id="{{ $mbg->id_mbg ?? 0 }}" data-field="diambil"
                                {{ optional($mbg)->diambil ? 'checked' : '' }}>
                        </td>
                        <td class="align-middle">
                            <input type="checkbox" class="toggle-status form-check-input" data-id="{{ $mbg->id_mbg ?? 0 }}" data-field="dikembalikan"
                                {{ optional($mbg)->dikembalikan ? 'checked' : '' }}>
                        </td>
                        <td class="align-middle">
                            @if (!empty($mbg) && $mbg->foto)
                                <img src="{{ asset('storage/' . $mbg->foto) }}" class="img-thumbnail" width="80">
                            @else
                                <span class="text-danger fw-bold">Foto belum diinput</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if (empty($mbg) || !$mbg->foto)
                                <a href="{{ route('mbgs.inputFoto', $mbg->id_mbg ?? 0) }}" class="btn btn-sm btn-primary">Upload Foto</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Tambahkan script untuk AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.toggle-status').change(function () {
            let mbgId = $(this).data('id');
            let field = $(this).data('field');
            let status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('mbgs.updateStatus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: mbgId,
                    field: field,
                    status: status
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function (xhr) {
                    alert("Gagal mengupdate status!");
                }
            });
        });
    });
</script>
@endsection
