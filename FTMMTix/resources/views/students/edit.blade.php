@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ $student->nim }}">
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $student->name }}">
        </div>
        <!-- Email dihapus untuk mahasiswa -->
        <div class="mb-3">
            <label>Password (isi jika mau ubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
    <form method="POST" action="{{ route('account.delete') }}" class="d-inline mt-2" onsubmit="return confirm('Yakin ingin menghapus akun? Tindakan ini tidak bisa dibatalkan.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Akun</button>
    </form>
</div>
@endsection
