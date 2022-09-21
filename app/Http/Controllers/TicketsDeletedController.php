<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketsDeletedController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tickets = Ticket::onlyTrashed()->get();
        return TicketResource::collection($tickets);
    }

    //Restore ticket
    public function show($ticket): TicketResource
    {
        $ticket = Ticket::onlyTrashed()->find($ticket);
        $ticket->restore();
        return TicketResource::make($ticket);
    }
}
