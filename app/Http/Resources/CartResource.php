<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cakes' => CartCakeResource::collection($this->cartCakes),
            'custom_cakes' => CartCustomCakeResource::collection($this->cartCustomCakes),
        ];
    }
}
