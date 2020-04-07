<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->words(rand(2, 4), true),
        'slug' => Str::slug($name),
        'sku' => $faker->numberBetween(1000000, 1999999),
        'price' => $faker->randomFloat(2, 5, 100),
        'stock_quantity' => rand(0, 100),
        'product_type' => Arr::random(Product::PRODUCT_TYPES),
        'image_id' => optional(Image::inRandomOrder()->first())->id,
        'excerpt' => $faker->text(100),
        'description' => $description = $faker->text(200),
        'admin_comment' => $faker->text(50),
        'show_on_home_page' => $faker->boolean,
        'tags' => null,
        'manufacturer_part_number' => $faker->randomNumber(6),
        'published' => $faker->boolean,
        'meta_title' => $name,
        'meta_description' => $description,
        'meta_keywords' => implode(',', $faker->words(rand(4, 10))),
    ];
});
