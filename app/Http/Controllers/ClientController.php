<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{

    public function show(Client $client): ClientResource
    {
        return ClientResource::make($client);
    }

    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection(Client::all());
    }

    public function store(ClientStoreRequest $request): ClientResource
    {
        return ClientResource::make(Client::create($request->validated()));
    }

    public function update(Client $client, ClientUpdateRequest $request): JsonResponse|ClientResource
    {
        $client->fill($request->validated());
        if($client->isClean()){
          return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }
        $client->save();
        return  ClientResource::make($client);
    }

    public function destroy(Client $client): ClientResource
    {
        $client->delete();
        return ClientResource::make($client);
    }

    public function showIdentifier(Request $request)
    {
        $validated = $request->validate(['identifier' => ['required','integer']]);
        return ClientResource::make(Client::where('identifier','=',$validated['identifier'])->firstOrFail());
    }

}
