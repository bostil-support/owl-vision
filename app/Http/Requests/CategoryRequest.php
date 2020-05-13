<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:32',
            'slug' => 'required|string|max:32',
            'description' => 'nullable|string',
            'template' => 'nullable|string',
            'parent_id' => 'numeric|nullable|exists:categories,id',
            'image_id' => 'nullable|integer|exists:images,id',
            'page_size' => 'integer|min:0',
            'allow_select_page_size' => 'boolean',
            'page_size_options' => 'nullable|string',
            'price_range' => 'nullable|string',
            'show_on_home_page' => 'boolean',
            'featured_on_home_page' => 'boolean',
            'show_on_search_box' => 'boolean',
            'search_box_order' => 'integer|min:0',
            'show_on_top_menu' => 'boolean',
            'published' => 'boolean',
            'flag' => 'nullable|string',
            'flag_style' => 'nullable|string',
            'icon' => 'nullable|string',
            'default_sort' => 'integer|min:0',
            'hide_on_catalog' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ];
    }
}
