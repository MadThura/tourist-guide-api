<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'username' => $this->name,
            'profileImgUrl' => $this->profile_img ? asset('/storage' . $this->profile_img) : null,
            'email' => $this->email,
        ];
    }
}
