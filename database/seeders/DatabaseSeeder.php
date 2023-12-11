<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Product::factory(10)->create();

        User::create([
            'name' => 'Ilham Maulana',
            'email' => 'ilham@gmail.com',
            'password' => bcrypt('qwer123'),
            'email_verified_at' => now(),
            'is_admin' => 1
        ]);

        Category::create([
            'nama_kategori' => 'Makanan',
            'slug' => 'makanan'
        ]);

        Category::create([
            'nama_kategori' => 'Minuman',
            'slug' => 'minuman'
        ]);

      
        // \App\Models\User::factory(10)->create();
    }
}
