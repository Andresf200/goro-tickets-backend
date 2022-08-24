<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'identifier' => $this->resource->identifier,
            'name' => $this->resource->name,
            'last_name' => $this->resource->last_name,
            'phone' => $this->resource->phone,
            'address' => $this->resource->address,
        ];
    }

    public static function collection($resource)
    {
        return parent::collection($resource);
    }
}
