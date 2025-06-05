<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kontak' => $this->faker->name(),
            'nomor_handphone' => $this->faker->phoneNumber(),
            'image_kontak' => null, // Bisa kamu isi URL dummy jika perlu
            'email_kontak' => $this->faker->unique()->safeEmail(),
            'alamat_kontak' => $this->faker->address(),
            'jumlah_transaksi' => $this->faker->numberBetween(0, 100),
        ];
    }
}
