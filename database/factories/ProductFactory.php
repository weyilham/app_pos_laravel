<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        

        return [
            //
            'id_kategori' => $this->faker->numberBetween(1, 2),
            'nama_produk' => $this->faker->word(),
            'gambar_produk' => $this->faker->imageUrl(640, 480, 'product', true),
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $this->faker->numberBetween(10000, 30000)
        ];
    }

    
}
