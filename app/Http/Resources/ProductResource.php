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
            'category' => $this->category?->name,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'image_url' => $this->image_url,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
            'is_visible' => $this->is_visible,
            'hub_product_id' => $this->hub_product_id,
            'created_at' => $this->created_at,
        ];
    }
}
