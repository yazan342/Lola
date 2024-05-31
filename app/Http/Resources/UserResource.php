<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function __construct($user, $token)
    {
        $this->resource = $user;
        $this->token = $token;
    }

    public function toArray($request)
    {
        return [
            'user' => [
                'id' => $this->id,
                'full_name' => $this->full_name,
                'email' => $this->email,
                'image' => $this->image,
                'phone_number' => $this->phone_number,
            ],
            'token' => $this->token,
        ];
    }
}
