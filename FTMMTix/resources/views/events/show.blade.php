@extends('layouts.app')

@section('content')
<div class="container py-5">
  <!-- Hero Section -->
  <div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center">
    <h1 class="display-4 fw-bold text-primary">{{ $event->title }}</h1>
    <p class="lead text-secondary">{{ $event->description }}</p>
  </div>

  <div class="row align-items-center">
    <!-- Poster Event -->
    <div class="col-md-6 mb-4 mb-md-0">
      @if($event->poster_path)
        <img src="{{ asset('storage/'.$event->poster_path) }}" class="img-fluid rounded shadow-sm" alt="{{ $event->title }}">
      @else
        <div class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center text-muted rounded shadow-sm">
          No Image Available
        </div>
      @endif
    </div>

    <!-- Detail Event -->
    <div class="col-md-6">
      <div class="bg-white p-4 rounded shadow-sm">
        <h3 class="text-warning fw-bold mb-3">Detail Event</h3>
        <ul class="list-unstyled fs-5">
          <li><strong class="text-primary">Tanggal:</strong> {{ $event->start_at->format('d M Y H:i') }}</li>
          @if($event->end_at)
            <li><strong class="text-primary">Selesai:</strong> {{ $event->end_at->format('d M Y H:i') }}</li>
          @endif
          <li><strong class="text-primary">Tempat:</strong> {{ $event->venue }}</li>
          <li><strong class="text-primary">Harga:</strong>
            {{ $event->price == 0 ? 'Free' : 'Rp'.number_format($event->price, 0, ',', '.') }}
          </li>
        </ul>

        <!-- Tombol Pesan Tiket -->
        <a href="{{ route('order.create', ['id' => $event->id]) }}" class="btn btn-success btn-lg mt-3">Pesan Tiket</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
@endsection
