@extends('layouts.app')
@section('content')
<h3>Checkout</h3>

<div class="card">
  <div class="card-body">

    {{-- Ringkasan Pesanan --}}
    <table class="table table-bordered">
      <tr><th>Event</th><td>{{ $event->title }}</td></tr>
      <tr><th>Tanggal</th><td>{{ $event->start_at->format('d M Y H:i') }}</td></tr>
      <tr><th>Lokasi</th><td>{{ $event->venue }}</td></tr>
      <tr><th>Qty</th><td>{{ $cart['qty'] }}</td></tr>
      <tr><th>Harga Satuan</th><td>Rp {{ number_format($cart['unit_price'],0,',','.') }}</td></tr>
      <tr><th>Total</th><td><strong>Rp {{ number_format($cart['subtotal'],0,',','.') }}</strong></td></tr>
    </table>

    {{-- Aksi --}}
    <form method="post" action="{{ route('checkout.place') }}">
      @csrf
      <div class="d-flex justify-content-between">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Kembali</a>
        <button class="btn btn-success">Lanjut ke Pembayaran</button>
      </div>
    </form>

  </div>
</div>
@endsection
