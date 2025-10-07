@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center">
    <h1 class="display-4 fw-bold text-primary">Pesan Tiket</h1>
    <p class="lead text-secondary">Isi formulir di bawah untuk memesan tiket event <strong>{{ $event['title'] }}</strong>.</p>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="bg-white p-4 rounded shadow-sm">
  <form action="{{ isset($event['is_dummy']) && $event['is_dummy'] ? url('/event/dummy/'.$event['id'].'/order') : route('order.store') }}" method="POST">
          @csrf
          <input type="hidden" name="event_id" value="{{ $event['id'] }}">

          <div class="mb-3">
            <label for="name" class="form-label text-primary">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label text-primary">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
          </div>

          <div class="mb-3">
            <label for="quantity" class="form-label text-primary">Jumlah Tiket</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan jumlah tiket" min="1" required>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg">Pesan Sekarang</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection