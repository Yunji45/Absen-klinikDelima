<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\shift;
use App\Models\User;
use App\Models\jadwal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        $factory->define(jadwal::class, function (Faker $faker) {
            $data = [
                'user_id' => factory(User::class)->create()->id,
                // 'shift_id' => factory(Shift::class)->create()->id, // Jika Anda ingin mengisi kolom 'shift_id'
            ];
        
            for ($i = 1; $i <= 31; $i++) {
                $namaKolom = 'J_' . $i;
                $data[$namaKolom] = factory(shift::class)->create()->id;
            }
        
            return $data;
        });
            }
}
