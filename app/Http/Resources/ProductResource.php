<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'product_type' => $this->product_type,
            'image_id' => $this->image_id,
            'image' => new ImageResource($this->whenLoaded('image')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'admin_comment' => $this->admin_comment,
            'show_on_home_page' => $this->show_on_home_page,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'manufacturer_part_number' => $this->manufacturer_part_number,
            'published' => $this->published,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
