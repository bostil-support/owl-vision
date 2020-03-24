<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
          'description' => $this->description,
          'slug' => $this->slug,
          'template' => $this->template,
          'meta_title' => $this->meta_title,
          'meta_description' => $this->meta_description,
          'meta_keywords' => $this->meta_keywords,
//          'parent_id' => $this->parent_id,
          'image' => new ImageResource($this->whenLoaded('image')),
          'page_size' => $this->page_size,
          'allow_select_page_size' => $this->allow_select_page_size,
          'page_size_options' => $this->page_size_options,
          'price_range' => $this->price_range,
          'show_on_home_page' => $this->show_on_home_page,
          'featured_on_home_page' => $this->featured_on_home_page,
          'show_on_search_box' => $this->show_on_search_box,
          'search_box_order' => $this->search_box_order,
          'show_on_top_menu' => $this->show_on_top_menu,
          'published' => $this->published,
          'flag' => $this->flag,
          'flag_style' => $this->flag_style,
          'icon' => $this->icon,
          'default_sort' => $this->default_sort,
          'hide_on_catalog' => $this->hide_on_catalog,
          'children' => self::collection($this->whenLoaded('children')),
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
        ];
    }
}
