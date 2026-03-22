<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'price' => $this->price,
            'rental_price' => $this->rental_price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'image_url' => $this->image_url,
            'is_visible' => $this->is_visible,
            'is_available' => $this->is_available,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
