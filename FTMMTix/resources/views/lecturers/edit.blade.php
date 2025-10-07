@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h3>Edit Akun Dosen</h3>
  <form method="POST" action="{{ route('account.update') }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="nip">NIP</label>
      <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip', $lecturer->nip) }}" required>
    </div>
    <div class="mb-3">
      <label for="name">Nama</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $lecturer->name) }}" required>
    </div>
    <div class="mb-3">
      <label for="password">Password (kosongkan jika tidak ganti)</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  </form>
  <form method="POST" action="{{ route('account.delete') }}" class="mt-3" onsubmit="return confirm('Yakin ingin menghapus akun?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Hapus Akun</button>
  </form>
</div>
@endsection
