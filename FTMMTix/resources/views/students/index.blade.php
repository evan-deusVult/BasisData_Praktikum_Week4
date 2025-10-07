@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->nim }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
