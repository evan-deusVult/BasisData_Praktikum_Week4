<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Order, Bank, Payment, Ticket};
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showBanks(Order $order){
        $banks = Bank::where('is_active',true)->get();
        $payment = $order->payment;
        return view('payments.banks', compact('order','payment','banks'));
    }

    public function chooseBank(Request $request, Order $order){
        $data = $request->validate(['bank_id'=>'required|exists:banks,id']);
        $order->payment->update(['bank_id'=>$data['bank_id'],'status'=>'AWAITING_CONFIRMATION']);
        return back()->with('ok','Silakan transfer sesuai nominal lalu unggah bukti.');
    }

    public function confirmTransfer(Request $request, Order $order){
        $request->validate(['transfer_ref'=>'required|string']);
        return DB::transaction(function() use ($order,$request){
            $order->payment->update([
                'status'=>'PAID',
                'paid_at'=>now(),
                'transfer_ref'=>$request->transfer_ref,
            ]);
            $order->update(['status'=>'PAID']);
            // generate one ticket per qty
            $item = $order->items()->first();
            for($i=0; $i<$item->qty; $i++){
                Ticket::create([
                    'order_id'=>$order->id,
                    'event_id'=>$item->event_id,
                    'code'=> strtoupper(uniqid('FTMM')).$i,
                ]);
            }
            return redirect()->route('tickets.show', $order);
        });
    }
}

