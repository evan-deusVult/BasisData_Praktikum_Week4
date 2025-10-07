@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Event</h1>
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Workshop">Workshop</option>
                <option value="Seminar">Seminar</option>
                <option value="Networking">Networking</option>
                <option value="Sports">Sports</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="open">Open</option>
            </select>
        </div>        <div class="mb-3 row">
            <div class="col">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="col">
                <label for="start_time" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="col">
                <label for="end_time" class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="participants" class="form-label">Kuota Peserta</label>
            <input type="text" class="form-control" id="participants" name="participants">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="0"
                onfocus="if(this.value==0)this.value='';" required>        </div>
        <div class="mb-3">
            <label for="organizer" class="form-label">Penyelenggara</label>
            <input type="text" class="form-control" id="organizer" name="organizer">
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label">Poster Event</label>
            <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
