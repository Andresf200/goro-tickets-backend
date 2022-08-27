<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketSellerController extends Controller
{
    /**
     * @description busca todas boletas con la cedula del vendedor nombre o apellido
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request):JsonResponse|AnonymousResourceCollection
    {
        $validated = $request->validate([
            'identifier' => ['integer'],
            'name' => ['string'],
            'last_name' => ['string'],
        ]);

        if ($validated === []) {
            return response()->json(['status' => 422, 'message' => "Debe especificar al menos un valor"]);
        }

        return TicketResource::collection(Seller::Where(function ($query) use ($validated) {
            foreach ($validated as $key => $data) {
                $query->where($key, '=', $data);
            }
        })->get()->firstOrFail()->tickets);
    }

    /**
     * @description busca todas las boletas por el id del vendedor
     * @param Seller $seller
     * @return AnonymousResourceCollection
     */
    public function show(Seller  $seller): AnonymousResourceCollection
    {
        return TicketResource::collection($seller->tickets);
    }
}
