@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Pembayaran untuk Pesanan #{{ $order->id }}</h3>
    <p>Total yang harus dibayar: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></p>

    <form method="POST" action="{{ route('payments.chooseBank', $order) }}">
        @csrf
        <div class="mb-3">
            <label for="bank_id" class="form-label">Pilih Bank</label>
            <select name="bank_id" id="bank_id" class="form-control" onchange="showBankInfo()">
                <option value="">-- Pilih Bank --</option>
                @foreach($banks as $bank)
                    <option value="{{ $bank->id }}" data-rek="{{ $bank->account_number }}" data-nama="{{ $bank->account_name }}">{{ $bank->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="bank-info" class="mb-3" style="display:none;">
            <div class="alert alert-info">
                <span id="bank-name"></span><br>
                No. Rekening: <span id="bank-rek"></span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Pilih Bank</button>
    </form>
    <script>
    function showBankInfo() {
        var select = document.getElementById('bank_id');
        var idx = select.selectedIndex;
        var option = select.options[idx];
        var rek = option.getAttribute('data-rek');
        var nama = option.getAttribute('data-nama');
        if(rek && nama) {
            document.getElementById('bank-info').style.display = '';
            document.getElementById('bank-name').textContent = nama;
            document.getElementById('bank-rek').textContent = rek;
        } else {
            document.getElementById('bank-info').style.display = 'none';
        }
    }
    </script>

    @if($payment && $payment->status === 'AWAITING_CONFIRMATION')
    <hr>
    <form method="POST" action="{{ route('payments.confirmTransfer', $order) }}">
        @csrf
        <div class="mb-3">
            <label for="transfer_ref" class="form-label">Masukkan Kode/Referensi Transfer</label>
            <input type="text" class="form-control" name="transfer_ref" required>
        </div>
        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
    </form>
    @endif
</div>
@endsection
