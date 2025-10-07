@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">Riwayat Transaksi Tiket</h2>

  @if($orders->isEmpty())
    <div class="alert alert-info text-center p-5 rounded shadow-sm">
      <h5 class="mb-2">Belum ada transaksi tiket.</h5>
      <p class="mb-0">Kamu bisa mulai memesan tiket di halaman <a href="{{ url('/') }}">beranda</a>.</p>
    </div>
  @else
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Kode Order</th>
            <th>Event</th>
            <th>Jumlah Tiket</th>
            <th>Total</th>
            <th>Status Pembayaran</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            @php
              $item = $order->orderItems->first();
              $event = $item?->event;
            @endphp
            <tr>
              <td><strong>{{ $order->code }}</strong></td>
              <td>{{ $event?->title ?? '-' }}</td>
              <td>{{ $item?->qty ?? 0 }}</td>
              <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
              <td>
                <span class="badge bg-{{ $order->payment?->status == 'PAID' ? 'success' : 'warning' }}">
                  {{ $order->payment?->status ?? 'UNPAID' }}
                </span>
              </td>
              <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
