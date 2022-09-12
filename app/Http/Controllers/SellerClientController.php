<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerClientController extends Controller
{
    public function show(Seller $seller)
    {
        $clients = [];
        foreach ($seller->tickets as $ticket){
            $clients[] = $ticket->client;
        }
        return ClientResource::collection($clients);
    }
}
