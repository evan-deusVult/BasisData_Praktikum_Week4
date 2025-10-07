@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang di dashboard admin FTMMTix!</p>

    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">+ Tambah Event</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Judul</th>
            <th>Venue</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach(\App\Models\Event::orderByDesc('start_at')->get() as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->venue }}</td>
            <td>{{ $event->start_at }}</td>
            <td>{{ $event->end_at }}</td>
            <td>{{ $event->is_published ? 'Published' : 'Draft' }}</td>
            <td>
                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
