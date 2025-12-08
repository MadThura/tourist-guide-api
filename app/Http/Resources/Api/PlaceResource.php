<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'location'    => $this->location,
            'latitude'    => $this->latitude,
            'longitude'   => $this->longitude,

            // full image URL
            'imageUrl'    => $this->image ? asset('storage/' . $this->image) : null,

            // category name
            'category'    => $this->category ? $this->category->name : null,

            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
