<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ChamadoFactory;
use App\Models\Chamado;

class ChamadoSeeder extends Seeder
{
    public function run()
    {
        Chamado::factory()->count(5)->create();
    }
}
