<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Iphone',
                'description' => 'Smartphone',
                'price' => 1000000,
                'image' => 'https://www.apple.com/newsroom/images/2024/09/apple-introduces-iphone-16-and-iphone-16-plus/article/geo/Apple-iPhone-16-finish-lineup-geo-240909_big.jpg.large.jpg',
                'stock' => 50,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Buku Pemrograman',
                'description' => 'Buku tentang pemrograman',
                'price' => 1000000,
                'image' => 'https://ebooks.gramedia.com/ebook-covers/46052/image_highres/ID_BMWP2019MTH02BMWP.jpg',
                'stock' => 20,
                'product_category_id' => 2,
            ],
                        [
                'name' => 'Seblak Mercon',
                'description' => 'Seblak pedas yang menggugah selera',
                'price' => 20000,
                'image' => 'https://cdn.rri.co.id/berita/Tarakan/o/1727599968000-IMG_9441/adj5y4yvj4j0d06.png',
                'stock' => 15,
                'product_category_id' => 3,
            ],
        ]);
    }
}
