<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'max:32',
                Rule::unique('products')->ignore($this->product)
            ],
            'sku' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock_quantity' => 'integer|min:0',
            'product_type' => [
                'required',
                'string',
                'regex:/^(' . implode('|', Product::TYPES) . ')$/'
            ],
            'image_id' => 'nullable|integer|exists:images,id',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'admin_comment' => 'nullable|string',
            'show_on_home_page' => 'boolean',
            'manufacturer_part_number' => 'nullable|string|max:255',
            'published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'tags' => 'array',
        ];
    }
}
