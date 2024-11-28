<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "id"=> $this->id,
          "type"=> $this->type == "a" ? "Apartment" : "House",
          "address" => $this->address,
          "size" => $this->size,
          "number_of_bedrooms" => $this->number_of_bedrooms,
          "price" => $this->price,
          "geolat" => $this->geolat,
          "geolng" => $this->geolng
        
        ];
    }
}
