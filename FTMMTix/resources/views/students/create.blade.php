@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mahasiswa</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
