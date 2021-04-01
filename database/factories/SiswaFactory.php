<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Siswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nisn' => $this->faker->unique()->randomNumber(9),
            'nis' => $this->faker->unique()->randomNumber(8),
            'nama' => $this->faker->firstName,
            'id_kelas' => $this->faker->numberBetween(1, 2),
            'alamat' => $this->faker->address,
            'no_telp' => '0831' . $this->faker->randomNumber(8),
            'id_spp' => 1,//$this->faker->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
