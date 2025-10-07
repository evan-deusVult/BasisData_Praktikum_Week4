@extends('layouts.app')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4>Edit Akun {{ $type == 'user' ? 'Umum' : ($type == 'lecturer' ? 'Dosen' : 'Mahasiswa') }}</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('account.update') }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password (isi jika ingin ganti)</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter">
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          </form>
          <form method="POST" action="{{ route('account.delete') }}" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus akun?')">Hapus Akun</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
