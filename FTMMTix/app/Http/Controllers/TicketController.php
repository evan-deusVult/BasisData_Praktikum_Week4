<?php
namespace App\Http\Controllers;
use App\Models\{Order};

class TicketController extends Controller
{
    public function show(Order $order){
        $userId = auth('user')->id();
        $studentId = auth()->id();
        $lecturerId = auth('lecturer')->id();
        $isOwner = false;
        if ($order->user_id && $order->user_id === $userId) {
            $isOwner = true;
        } elseif ($order->student_id && $order->student_id === $studentId) {
            $isOwner = true;
        } elseif ($order->lecturer_id && $order->lecturer_id === $lecturerId) {
            $isOwner = true;
        }
        abort_if(!$isOwner, 403);
        $tickets = $order->load('items','payment')->tickets ?? $order->tickets;
        return view('tickets.show',[ 'order'=>$order, 'tickets'=>$order->tickets ]);
    }
}
