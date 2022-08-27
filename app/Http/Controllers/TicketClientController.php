<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketClientController extends Controller
{
    public function show(Request $request)
    {
        //busca todas boletas con la cedula del cliente nombre o apellido
        $validated = $request->validate([
            'identifier' => ['integer'],
            'name' => ['string'],
            'last_name' => ['string'],
        ]);
        dd($validated);

    }

    public function index()
    {
        //busca las boletas por el id del cliente
    }
}
