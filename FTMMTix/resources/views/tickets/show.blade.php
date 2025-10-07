@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h4>E-Ticket Pesanan #{{ $order->code }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Total:</strong> Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>

            <hr>
            <h5>Daftar Tiket</h5>
            <ul class="list-group">
                @foreach ($tickets as $ticket)
                    <li class="list-group-item">
                        🎟️ Kode Tiket: <strong>{{ $ticket->code }}</strong> <br>
                        Event ID: {{ $ticket->event_id }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
