@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $event->title }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $event->category }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
            <option value="Open">Open</option>
            <option value="Full" {{ $event->status == 'full' ? 'selected' : '' }}>Full</option>
            </select>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($event->start_at)->format('Y-m-d') }}" required>
            </div>
            <div class="col">
                <label for="start_time" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($event->start_at)->format('H:i') }}" required>
            </div>
            <div class="col">
                <label for="end_time" class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($event->end_at)->format('H:i') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $event->venue }}" required>
        </div>
        <div class="mb-3">
            <label for="participants" class="form-label">Kuota Peserta</label>
            <input type="text" class="form-control" id="participants" name="participants" value="{{ $event->participants }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="{{ intval($event->price) }}">
        </div>
        <div class="mb-3">
            <label for="organizer" class="form-label">Penyelenggara</label>
            <input type="text" class="form-control" id="organizer" name="organizer" value="{{ $event->organizer }}">
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster Event</label>
            <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
            @if($event->poster_path)
                <img src="{{ asset('storage/'.$event->poster_path) }}" alt="Poster" style="max-width:120px;max-height:120px;" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    <a href="/" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
