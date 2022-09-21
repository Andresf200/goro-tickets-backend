<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{

    public function show(Ticket $ticket): TicketResource
    {
        return TicketResource::make($ticket);
    }

    public function index(): ?AnonymousResourceCollection
    {
        return TicketResource::collection(Ticket::all());
    }

    public function store(TicketStoreRequest $request): AnonymousResourceCollection
    {
        $tickets = [];

        foreach (array_unique($request->validated('num_tickets')) as $num_ticket){
            $tickets[] = $ticket = Ticket::make([
                    'price' => ($request->price == null)? 35000 : $request->price,
                    'remaining_amount' => ($request->price == null)? 35000 : $request->price,
                    'id_seller' => $request->id_seller,
                    'id_client' => $request->id_client,
                ]);
            $ticket->fill(['num_ticket' => $num_ticket,"date_register" => now()])->save();
        }
        return TicketResource::collection($tickets);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket): JsonResponse|TicketResource
    {
        $ticket->fill($request->validated());
        if($ticket->isClean()){
            return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }
        $ticket->save();
        return TicketResource::make($ticket);
        //funciona
    }

    public function showNumTicket(Request $request): TicketResource
    {
        $validated = $request->validate(['num_ticket' => ['required','integer']]);
        return TicketResource::make(Ticket::where('num_ticket','=',$validated['num_ticket'])->firstOrFail());
    }

    public function destroy(Ticket $ticket): TicketResource
    {
        $ticket->delete();
        return TicketResource::make($ticket);
    }



}
