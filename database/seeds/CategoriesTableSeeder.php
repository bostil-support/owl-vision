<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Computers',
                'slug' => 'computers',
                'parent_id' => null,
            ],
            [
                'id' => 2,
                'name' => 'Desktops',
                'slug' => 'desktops',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Notebooks',
                'slug' => 'notebooks',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Software',
                'slug' => 'software',
                'parent_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'parent_id' => null,
            ],
            [
                'id' => 6,
                'name' => 'Camera & photo',
                'slug' => 'camera-and-photo',
                'parent_id' => 5,
            ],
            [
                'id' => 7,
                'name' => 'Cell phones',
                'slug' => 'cell-phones',
                'parent_id' => 5,
            ],
            [
                'id' => 8,
                'name' => 'Others',
                'slug' => 'others',
                'parent_id' => 5,
            ],
            [
                'id' => 9,
                'name' => 'Apparel',
                'slug' => 'apparel',
                'parent_id' => null,
            ],
            [
                'id' => 10,
                'name' => 'Shoes',
                'slug' => 'shoes',
                'parent_id' => 9,
            ],
            [
                'id' => 11,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'parent_id' => 9,
            ],
            [
                'id' => 12,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'parent_id' => 9,
            ],
            [
                'id' => 13,
                'name' => 'Digital downloads',
                'slug' => 'digital-downloads',
                'parent_id' => null,
            ],
            [
                'id' => 14,
                'name' => 'Books',
                'slug' => 'books',
                'parent_id' => null,
            ],
            [
                'id' => 15,
                'name' => 'Jewelry',
                'slug' => 'jewelry',
                'parent_id' => null,
            ],
            [
                'id' => 16,
                'name' => 'Gift cards',
                'slug' => 'gift-cards',
                'parent_id' => null,
            ],
        ]);
    }
}
