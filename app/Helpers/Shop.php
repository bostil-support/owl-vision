<?php


namespace App\Helpers;


use App\Models\Product;

class Shop
{
    public static function price(float $value): string
    {
        return sprintf('%s%s', self::currency(), number_format($value, 2, ',', ' '));
    }

    public static function currency(): string
    {
        return '$';
    }

    /**
     * @param Product $product
     * @return string
     */
    public static function getProductHtmlPermalink(Product $product): string
    {
        return view(
            'partials.alert-permalink-entity',
            [
                'title' => $product->name,
                'permalink' => route(
                    'frontend.shop.product',
                    [$product->categories()->first()->slug, $product->slug]
                )
            ]
        )->toHtml();
    }
}