<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellerResource;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SellersDeletedController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $sellers = Seller::onlyTrashed()->get();
        return SellerResource::collection($sellers);
    }

    //Restore seller
    public function show($seller): SellerResource
    {
        $seller = Seller::onlyTrashed()->find($seller);
        $seller->restore();
        return SellerResource::make($seller);
    }
}
