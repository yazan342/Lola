<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'order_date' => $this->created_at,
            'cakes' => CakeResource::collection($this->whenLoaded('orderCakes')->pluck('cake')),
            'custom_cakes' => CustomCakeResource::collection($this->whenLoaded('orderCustomCakes')->pluck('customCake')),
        ];
    }
}
