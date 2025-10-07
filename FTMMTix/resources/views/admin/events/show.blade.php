@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Detail Event</h1>
    <div class="mb-3">
        <strong>Nama Event:</strong> {{ $event->name }}
    </div>
    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $event->date }}
    </div>
    <div class="mb-3">
        <strong>Lokasi:</strong> {{ $event->location }}
    </div>
    <div class="mb-3">
        <strong>Deskripsi:</strong> {{ $event->description }}
    </div>
    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
