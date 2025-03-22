@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data MBG</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mbgs.store') }}" method="POST">
        @csrf
        <label for="date">Pilih Tanggal:</label>
        <input type="date" name="date" required>
        <button type="submit">Generate Data</button>
    </form>
    
</div>
@endsection
