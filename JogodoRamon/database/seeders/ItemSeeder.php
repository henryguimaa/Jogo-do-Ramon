<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('item')->insert([
            [
                'nome' => 'Poção de Cura',
                'descricao' => 'Recupera 50 pontos de vida.',
                'tipo' => 'poção',
                'valor' => 25,
                'efeito' => 'cura +50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Espada Enferrujada',
                'descricao' => 'Uma velha espada com pouco dano, mas confiável.',
                'tipo' => 'arma',
                'valor' => 50,
                'efeito' => 'ataque +5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
