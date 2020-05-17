<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    protected $imageService;

    public function __construct(ImageService $imageService) {
        $this->imageService = $imageService;
    }

    /**
     * @param  array  $data
     *
     * @return \App\Models\Product
     * @throws \Throwable
     */
    public function store(array $data): Product
    {
        try {
            \DB::beginTransaction();

            $product = Product::create($data);

            $tags = array_key_exists('tags', $data) ? $data['tags'] : null;
            $this->syncTags($product, $tags);

            isset($data['product_images']) and $product->images()->sync($data['product_images']);

            \DB::commit();
        } catch (\Throwable $exception) {
            \DB::rollBack();

            throw $exception;
        }

        return $product;
    }

    /**
     * @param  \App\Models\Product  $product
     * @param  array  $data
     *
     * @return \App\Models\Product
     * @throws \Throwable
     */
    public function update(Product $product, array $data): Product
    {
        try {
            \DB::beginTransaction();

            $product->update($data);

            $tags = array_key_exists('tags', $data) ? $data['tags'] : null;
            $this->syncTags($product, $tags);

            isset($data['product_images']) and $product->images()->sync($data['product_images']);

            \DB::commit();
        } catch (\Throwable $exception) {
            \DB::rollBack();

            throw $exception;
        }

        return $product;
    }

    /**
     * @param  \App\Models\Product  $product
     * @param  array|null  $tags
     */
    public function syncTags(Product $product, ?array $tags)
    {
        if (is_array($tags)) {
            $tagIds = (new TagService)->getIds($tags);

            $product->tags()->sync($tagIds);
        } else {
            $product->tags()->detach();
        }
    }
}