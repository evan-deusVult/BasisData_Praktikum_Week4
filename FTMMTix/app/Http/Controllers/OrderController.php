<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{Event, TicketType, Order, OrderItem, Payment};

class OrderController extends Controller
{
    public function addToCart(Request $request, Event $event)
    {
        $data = $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'qty'            => 'required|integer|min:1'
        ]);

        $tt = TicketType::findOrFail($data['ticket_type_id']);
        $subtotal = $tt->price * $data['qty'];

        session(['cart' => [
            'event_id'       => $event->id,
            'ticket_type_id' => $tt->id,
            'qty'            => $data['qty'],
            'unit_price'     => $tt->price,
            'subtotal'       => $subtotal
        ]]);

        return redirect()->route('checkout');
    }

    public function checkout()
    {
        $cart = session('cart');
        abort_if(!$cart, 404);

        $event = Event::findOrFail($cart['event_id']);
        return view('checkout.index', compact('cart', 'event'));
    }

    public function history()
    {
    $user = auth('user')->user() ?? auth('lecturer')->user() ?? auth()->user();

    if (!$user) {
        return redirect()->route('login')->withErrors('Silakan login terlebih dahulu.');
    }

    // Ambil order milik user berdasarkan jenis akun
    $orders = Order::with(['orderItems.event', 'payment'])
        ->when(isset($user->role) && $user->role === 'lecturer', fn($q) => $q->where('lecturer_id', $user->id))
        ->when(isset($user->role) && $user->role === 'user', fn($q) => $q->where('user_id', $user->id))
        ->when(!isset($user->role) || $user->role === 'student', fn($q) => $q->where('student_id', $user->id))
        ->orderByDesc('created_at')
        ->get();

    return view('orders.history', compact('orders'));
    }

    public function placeOrder(Request $request)
    {






        $user = auth('user')->user() ?? auth('lecturer')->user() ?? auth()->user();
        if (!$user) {
            return redirect()->route('login')->withErrors('Harap login dulu sebelum memesan tiket.');
        }

        $cart = session('cart');
        abort_if(!$cart, 404);

        return DB::transaction(function () use ($cart, $user) {
            $orderData = [
                'code'         => 'FTMM-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'status'       => 'UNPAID',
                'total_amount' => $cart['subtotal'],
            ];
            // Set correct user id field
            if (isset($user->role) && $user->role === 'lecturer') {
                $orderData['lecturer_id'] = $user->id;
            } elseif (isset($user->role) && $user->role === 'user') {
                $orderData['user_id'] = $user->id;
            } else {
                $orderData['student_id'] = $user->id;
            }

            $order = Order::create($orderData);

            OrderItem::create([
                'order_id'       => $order->id,
                'event_id'       => $cart['event_id'],
                'ticket_type_id' => $cart['ticket_type_id'],
                'qty'            => $cart['qty'],
                'unit_price'     => $cart['unit_price'],
                'subtotal'       => $cart['subtotal'],
            ]);

            Payment::create([
                'order_id' => $order->id,
                'amount'   => $order->total_amount,
                'status'   => 'AWAITING_PAYMENT',
            ]);

            session()->forget('cart');

            return redirect()->route('payments.showBanks', $order->id)
                ->with('success', 'Order berhasil dibuat. Silakan lanjutkan ke pembayaran dan upload bukti transfer untuk mendapatkan e-ticket.');
        });

    }
}
