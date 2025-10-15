<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InimigoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inimigo')->insert([
            [
                'nome' => 'Lobo Sombrio',
                'vida' => 60,
                'ataque' => 12,
                'defesa' => 4,
                'velocidade' => 7,
                'experiencia_drop' => 50,
                'id_mapa' => 2, // Floresta Sombria
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Slime Verde',
                'vida' => 40,
                'ataque' => 8,
                'defesa' => 2,
                'velocidade' => 3,
                'experiencia_drop' => 25,
                'id_mapa' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
