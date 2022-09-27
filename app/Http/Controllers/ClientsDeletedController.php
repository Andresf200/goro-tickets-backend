<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientsDeletedController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
       $clients = Client::onlyTrashed()->get();
       return ClientResource::collection($clients);
    }

    //Restore client
    public function show($client): ClientResource
    {
        $client = Client::onlyTrashed()->find($client);
        $client->restore();
        return ClientResource::make($client);
    }
}
