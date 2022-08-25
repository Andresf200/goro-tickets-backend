<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function show(Ticket $ticket): TicketResource
    {
        return TicketResource::make($ticket);
    }

    public function index(): ?\Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TicketResource::collection(Ticket::all());
    }

    public function store(TicketStoreRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $tickets = [];
        foreach ($data as $insert){
            $tickets[] = Ticket::create($insert);
        }
        return TicketResource::collection($tickets);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket): \Illuminate\Http\JsonResponse|TicketResource
    {
        //todo update
    }

    public function destroy(Ticket $ticket): TicketResource
    {
        $ticket->delete();
        return TicketResource::make($ticket);
    }
}
