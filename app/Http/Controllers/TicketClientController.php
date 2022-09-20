<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketClientController extends Controller
{
    /**
     * @description busca todas boletas con la cedula del cliente nombre o apellido
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $validated = $request->validate([
            'identifier' => ['integer'],
            'name' => ['string'],
            'last_name' => ['string'],
        ]);

        if ($validated === []) {
            return response()->json(['status' => 422, 'message' => "Debe especificar al menos un valor"]);
        }

        return TicketResource::collection(Client::Where(function ($query) use ($validated) {
            foreach ($validated as $key => $data) {
                $query->where($key, '=', $data);
            }
        })->get()->firstOrFail()->tickets);
    }

    /**
     * @description busca todas las boletas por el id del cliente
     * @param Client $client
     * @return AnonymousResourceCollection
     */
    public function show(Client $client): AnonymousResourceCollection
    {
        return TicketResource::collection($client->tickets);
    }

    /**
     * @description Elimina el cliente de la relacion con el tickete
     * @param Ticket $ticket
     * @return
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->update(['id_client' => null]);

        return TicketResource::make($ticket);
    }
}
