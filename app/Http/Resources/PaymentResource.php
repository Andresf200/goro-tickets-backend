<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'date_pay' => $this->resource->date_pay,
            'mount' => $this->resource->mount,
            'remaining_amount' => $this->resource->RemainingAmount,
            'id_ticket' => $this->resource->id_ticket,
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
            'ticket' => TicketPaymentResource::make($this->resource->ticket),
            'seller' => SellerResource::make($this->resource->ticket->seller),
            'client' => ClientResource::make($this->resource->ticket->client)
        ];
    }
}
