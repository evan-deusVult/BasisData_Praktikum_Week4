@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Mahasiswa</h1>

    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->nim }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus mahasiswa ini?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
