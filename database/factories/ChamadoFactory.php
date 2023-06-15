<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as faker;
use App\Models\Chamado;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chamado>
 */
class ChamadoFactory extends Factory
{
    protected $model = Chamado::class;

    public function definition()
    {
        $startDate = '2022-01-01 00:00:00';
        $endDate = '2023-12-31 23:59:59';
        
        return [
            'Nome' => Str::title($this->faker->word),
            'Solicitante' => $this->faker->name,
            'ObjetoID' => null, // Gerará um número aleatório entre 1 e 424
            'SetorID' => 374, // Substitua pelo número de IDs do seu modelo Setor
            'Descricao' => $this->faker->paragraph,
            'Grau' => $this->faker->randomElement([1, 2, 3]),
            'Processo' => $this->faker->randomElement([0,1,2]),
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate),
            'Empresa' => 5,
        ];
    }
}
