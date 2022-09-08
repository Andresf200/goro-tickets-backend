<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerStoreRequest;
use App\Http\Requests\SellerUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\SellerResource;
use App\Models\Client;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    public function show(Seller $seller): SellerResource
    {
        return SellerResource::make($seller);
    }

    public function index(): ?\Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SellerResource::collection(Seller::all());
    }

    public function store(SellerStoreRequest $request): SellerResource
    {
        return SellerResource::make(Seller::create($request->validated()));
    }

    /**
     * @param SellerUpdateRequest $request
     * @param Seller $seller
     * @return JsonResponse|SellerResource
     */
    public function update(SellerUpdateRequest $request, Seller $seller): \Illuminate\Http\JsonResponse|SellerResource
    {
        $seller->fill($request->validated());
        if($seller->isClean()){
            return response()->json(['status' => 422,'message' => "Debe especificar al menos un valor diferente para actualizar"]);
        }
        $seller->save();
        return  SellerResource::make($seller);

    }

    public function destroy(Seller $seller): SellerResource
    {
        $seller->delete();
        return SellerResource::make($seller);
    }

    public function showIdentifier(Request $request)
    {
        $validated = $request->validate(['identifier' => ['required','integer']]);
        return SellerResource::make(Seller::where('identifier','=',$validated['identifier'])->firstOrFail());
    }
}
