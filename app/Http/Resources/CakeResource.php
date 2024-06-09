<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class CakeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        $isInCart = false;

        if ($user) {
            $isInCart = $user->cart->cartCakes->contains('cake_id', $this->id);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'flavor' => $this->flavor,
            'number_of_people' => $this->number_of_people,
            'price' => $this->price,
            'is_in_cart' => $isInCart,
        ];
    }
}
