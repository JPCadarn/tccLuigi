<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pagamento>
 */
class PagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'pago_a' => $this->faker->name(),
			'valor' => $this->faker->randomFloat(),
			'data_vencimento' => $this->faker->dateTime(),
			'data_pagamento' => $this->faker->dateTime(),
			'modo_pagamento' => 'pix'
        ];
    }
}
