<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Buat kategori
        $categories = [
            'Elektronik' => Category::firstOrCreate(
                ['name' => 'Elektronik'],
                ['slug' => 'elektronik']
            ),
            'Pakaian' => Category::firstOrCreate(
                ['name' => 'Pakaian'],
                ['slug' => 'pakaian']
            ),
            'Makanan' => Category::firstOrCreate(
                ['name' => 'Makanan'],
                ['slug' => 'makanan']
            ),
            'Minuman' => Category::firstOrCreate(
                ['name' => 'Minuman'],
                ['slug' => 'minuman']
            ),
            'Alat Tulis' => Category::firstOrCreate(
                ['name' => 'Alat Tulis'],
                ['slug' => 'alat-tulis']
            ),
        ];
        

        // Produk dengan kategori tetap
        $products = [
            ['name'=>'Smartphone Galaxy','sku'=>'SKU001','price'=>3500000,'stock'=>10,'category'=>'Elektronik'],
            ['name'=>'Laptop Dell','sku'=>'SKU002','price'=>7500000,'stock'=>5,'category'=>'Elektronik'],
            ['name'=>'Kaos Polos','sku'=>'SKU003','price'=>75000,'stock'=>50,'category'=>'Pakaian'],
            ['name'=>'Celana Jeans','sku'=>'SKU004','price'=>150000,'stock'=>30,'category'=>'Pakaian'],
            ['name'=>'Snack Coklat','sku'=>'SKU005','price'=>12000,'stock'=>100,'category'=>'Makanan'],
            ['name'=>'Minuman Soda','sku'=>'SKU006','price'=>8000,'stock'=>80,'category'=>'Minuman'],
            ['name'=>'Pensil 2B','sku'=>'SKU007','price'=>3000,'stock'=>200,'category'=>'Alat Tulis'],
            ['name'=>'Buku Tulis','sku'=>'SKU008','price'=>12000,'stock'=>150,'category'=>'Alat Tulis'],
            ['name'=>'Headphone','sku'=>'SKU009','price'=>450000,'stock'=>15,'category'=>'Elektronik'],
            ['name'=>'Mouse Wireless','sku'=>'SKU010','price'=>250000,'stock'=>20,'category'=>'Elektronik'],
            ['name'=>'Jaket Hoodie','sku'=>'SKU011','price'=>250000,'stock'=>25,'category'=>'Pakaian'],
            ['name'=>'Sepatu Sneakers','sku'=>'SKU012','price'=>450000,'stock'=>20,'category'=>'Pakaian'],
            ['name'=>'Kopi Instan','sku'=>'SKU013','price'=>15000,'stock'=>60,'category'=>'Minuman'],
            ['name'=>'Teh Celup','sku'=>'SKU014','price'=>12000,'stock'=>70,'category'=>'Minuman'],
            ['name'=>'Pulpen Gel','sku'=>'SKU015','price'=>5000,'stock'=>100,'category'=>'Alat Tulis'],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'sku' => $p['sku'],
                'price' => $p['price'],
                'stock' => $p['stock'],
                'category_id' => $categories[$p['category']]->id,
                'image' => null,
            ]);
        }

        $this->command->info("Seeder produk selesai. 15 produk dengan kategori tetap telah dibuat!");
    }
}
