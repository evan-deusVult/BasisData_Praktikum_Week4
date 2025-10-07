@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Event</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Tambah Event</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->start_at }}</td>
                <td>{{ $event->venue }}</td>
                <td>
                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus event?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
