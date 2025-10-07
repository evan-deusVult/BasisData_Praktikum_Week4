@extends('layouts.app')


@section('content')
<div class="container py-5">
  <div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center">
    <h1 class="display-4 fw-bold text-primary">{{ $event['title'] }}</h1>
    <p class="lead text-secondary">{{ $event['description'] }}</p>
  </div>

  <div class="row align-items-center">
    <div class="col-md-6">
      <img src="{{ asset($event['image']) }}" class="img-fluid rounded shadow-sm" alt="{{ $event['title'] }}">
    </div>
    <div class="col-md-6">
      <div class="bg-white p-4 rounded shadow-sm">
        <h3 class="text-warning fw-bold">Detail Event</h3>
        <ul class="list-unstyled fs-5">
          <li><strong class="text-primary">Tanggal:</strong> {{ $event['date'] }}</li>
          <li><strong class="text-primary">Tempat:</strong> {{ $event['location'] }}</li>
          <li><strong class="text-primary">Harga:</strong> Rp{{ number_format($event['price'], 0, ',', '.') }}</li>
        </ul>
        <a href="{{ route('order.create', ['id' => $event['id']]) }}" class="btn btn-success btn-lg mt-3">Pesan Tiket</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
@endsection