<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'num_ticket' => $this->resource->num_ticket,
            'date_register' => $this->resource->date_register,
            'price' => $this->resource->price,
            'id_seller' => $this->resource->id_seller,
            'id_client' => $this->resource->id_client,
            'included' => [
                $this->getIncludes()
            ]
        ];
    }

    public static function collection($resource)
    {
        return parent::collection($resource);
    }

    private function getIncludes()
    {
        return [
            'seller' => SellerResource::make($this->resource->seller),
            'client' => ClientResource::make($this->resource->client)
        ];
    }
}
