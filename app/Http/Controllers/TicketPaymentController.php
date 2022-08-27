<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketPaymentController extends Controller
{
    public function show(Ticket $ticket)
    {
        return PaymentResource::collection($ticket->payments);
    }
}
