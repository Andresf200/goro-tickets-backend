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
            'ticket' => TicketResource::make($this->resource->ticket)
        ];
    }
}
