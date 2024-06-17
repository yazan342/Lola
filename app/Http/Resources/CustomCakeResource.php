<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomCakeResource extends JsonResource
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
            'color' => new ColorResource($this->color),
            'flavor' => new FlavorResource($this->flavor),
            'topping' => new ToppingResource($this->topping),
            'shape' => new ShapeResource($this->shape),
            'price' => $this->price,
            'image' => $this->image,
            'text' => $this->text,
        ];
    }
}
