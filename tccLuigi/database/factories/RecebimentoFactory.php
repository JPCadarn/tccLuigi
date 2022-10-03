<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recebimento>
 */
class RecebimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'descricao' => Str::random(),
			'paciente' => $this->faker->name(),
			'valor' => $this->faker->randomFloat(),
			'data_vencimento' => $this->faker->dateTime(),
			'data_recebimento' => $this->faker->dateTime(),
			'modo_pagamento' => 'pix'
        ];
    }
}
