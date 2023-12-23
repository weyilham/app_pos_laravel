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

        $harga = ['10000', '15000', '17000', '20000', '25000', '30000'];
        $index = array_rand($harga);

        return [
            //
            'id_kategori' => $this->faker->numberBetween(1, 2),
            'nama_produk' => $this->faker->word(),
            'gambar_produk' => 'gambar-produk/default.jpg',
            'deskripsi' => $this->faker->paragraph(),
            'harga' => $harga[$index],
        ];
    }
}
